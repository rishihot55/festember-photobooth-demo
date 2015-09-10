import json, requests, shutil
# Global
HOSTNAME = "http://localhost:8000"

def fetch_image_urls(url):
    response = requests.get(url)
    json_array = response.json()
    image_urls = []
    for json_obj in json_array:
        image_urls = image_urls + [json_obj["image_url"]]
    return image_urls

def fetch_images(image_urls):
    for image_url in image_urls:
        url = HOSTNAME + '/images/' + image_url + '/download/'
        response = requests.get(url, stream=True)
        with open('downloaded_images/' + image_url, 'wb') as out_file:
            shutil.copyfileobj(response.raw, out_file)
        del response

def main():
    print "Enter choice:\n1. Download All Images\n2. Download Images by F-ID\n3. Download Today's Images: "
    choice = input()
    if choice == 1:
        url = HOSTNAME + "/images/"
    elif choice == 2:
        print "Enter festember id: "
        f_id = raw_input()
        url = HOSTNAME + "/images/festember_id/" + f_id
    elif choice == 3:
        url = HOSTNAME + "/images/today"
    else:
        return

    # Fetches list of all image_urls
    image_urls = fetch_image_urls(url)

    # Fetches the images given the list of URLS
    fetch_images(image_urls)


if __name__ == "__main__":
    main()
