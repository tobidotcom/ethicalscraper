import requests
from bs4 import BeautifulSoup
from urllib.parse import urljoin, urlparse
import threading
from queue import Queue
import time

class WebScraper:
    def __init__(self, base_url, depth):
        self.base_url = base_url
        self.depth = depth
        self.visited = set()
        self.lock = threading.Lock()
        self.queue = Queue()

    def scrape_info(self, url, current_depth):
        if current_depth > self.depth or url in self.visited:
            return
        print(f"Scraping URL: {url} at depth {current_depth}")  # Print the current URL and depth
        try:
            response = requests.get(url, headers={'User-Agent': 'Mozilla/5.0'})
            if response.status_code == 200:
                soup = BeautifulSoup(response.text, 'html.parser')
                self.lock.acquire()
                try:
                    self.visited.add(url)
                    # Save or process the data as needed
                    with open('output.txt', 'a', encoding='utf-8') as f:
                        f.write(f"URL: {url}\n")
                        f.write(f"Title: {soup.title.string if soup.title else 'No title'}\n")
                        f.write(f"Content:\n{soup.get_text()}\n")
                        f.write("="*80 + "\n")
                    print(f"Finished scraping URL: {url}")  # Print when finished scraping a URL
                finally:
                    self.lock.release()
                # Find all links and add them to the queue for further scraping
                for link in soup.find_all('a', href=True):
                    full_url = urljoin(url, link['href'])
                    if urlparse(full_url).hostname == urlparse(self.base_url).hostname:
                        self.queue.put((full_url, current_depth + 1))
                        print(f"Added to queue: {full_url}")  # Print when a URL is added to the queue
            else:
                print(f"Failed to retrieve URL: {url} with status code {response.status_code}")
        except requests.RequestException as e:
            print(f"Request failed for URL: {url} with exception: {e}")

    def worker(self):
        while True:
            url, depth = self.queue.get()
            self.scrape_info(url, depth)
            self.queue.task_done()

    def run(self):
        print("Starting the scraper")
        self.queue.put((self.base_url, 0))
        threads = []
        for _ in range(10):  # Number of threads
            t = threading.Thread(target=self.worker)
            t.daemon = True
            t.start()
            threads.append(t)
        self.queue.join()
        for t in threads:
            t.join()
        print("Scraper has finished")

if __name__ == "__main__":
    scraper = WebScraper('https://codegpt.co, 2)  # Set the base URL and depth
    scraper.run()
