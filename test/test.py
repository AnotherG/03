from selenium import webdriver
from selenium.common.exceptions import WebDriverException
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.common.by import By
import time 

# https://stackoverflow.com/a/26283818/1689770
chrome_options.add_argument("start-maximized")

# https://stackoverflow.com/a/43840128/1689770
chrome_options.add_argument("enable-automation")

# only if you are ACTUALLY running headless
chrome_options.add_argument("--headless")

# https://stackoverflow.com/a/50725918/1689770
chrome_options.add_argument("--no-sandbox")

# https://stackoverflow.com/a/43840128/1689770
chrome_options.add_argument("--disable-infobars")

# https://stackoverflow.com/a/50725918/1689770
chrome_options.add_argument("--disable-dev-shm-usage")

# https://stackoverflow.com/a/49123152/1689770
chrome_options.add_argument("--disable-browser-side-navigation")

# https://stackoverflow.com/questions/51959986/how-to-solve-selenium-chromedriver-timed-out-receiving-message-from-renderer-exc
chrome_options.add_argument("--disable-gpu")

chrome_options.add_argument("--disable-extensions")
chrome_options.add_argument("--dns-prefetch-disable")

homepage = "/home/Git/index.php"
class SeleniumTest(unittest.TestCase):

    def setUp(self):
        self.driver = None
        self.delay_time = 5
        try:
            self.driver = webdriver.Remote(
                command_executor="http://selenium-hub:4444/wd/hub",
                options=chrome_options,
            )
            self.driver.set_page_load_timeout(ACCEPTABLE_PAGE_LOADING_TIME_SECONDS)
            self.driver.get(homepage)
            self.driver.implicitly_wait('1')
        except WebDriverException as e:
            self.driver.browser.quit()
            if "ERR_CONNECTION_REFUSED" not in e.msg:
                print(e)	