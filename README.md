## Main goal:
Create a module in Laravel which will do search of products/items. It should include a searchform. After entering the product name it should show the list of matching results.

Each product/item should have the following parameters:
- ID (id)
- Image (image_url)
- Name (product_name)
- Category (categories)

## Tasks:
1. Use openfoodfacts API - https://world.openfoodfacts.org/cgi/search.pl?action=process&sort_by=unique_scans_n&page_size=20&json=1 to display products/items on the page (add paginationhere as well)
2. In front of each entry add a button/link, by click on which data will be saved to DB (orupdated in case it has been already saved before)
3. Cover your code with functional/unit tests

## Tech stack:
- PHP (last version)
- Laravel (last version)

## How to test
Run `docker-compose up -d`

Then open in your favorite browser http://localhost/search.

Enjoy!

After testing run `docker-compose down --remove-orphans -v` for stop docker containers, remove its volumes and cleanup
