## This repo is for a simple shopping cart task<br>

### Project Requirements
- Users
  - Admin CRUD, Client login
- Brands
  - Admin CRUD, Client list in home page
- Products
  - Admin CRUD, Client list in home page ,show details and add to cart
- Orders
  - Admin list & change state, Client checkout
- Admin & Client Login

### Notes
- User Roles: Admin & Client
- Home page (list brands & products) via public access
- Checkout Product (add to cart & checkout) for logged in Client
- Full CRUD operations for logged in Admin `ONLY`

### Developer Notes
- I'm not using Repository pattern because it's useless in this case & ORM is enough to me
- Here I'm not building full cart operations it's just add single product to cart `without increment or decrement` but DB is ready for theme
- We will write feature test `happy scenarios only` because there's no need for `unit test` at least for current time ,but in case we add services ,repositories ,etc.. `we most write unit tests for theme`

### Run Project Instructions
`IMP Hint`: I think you use linux OS , have PHP8.x & the needed libraries as Laravel doc says & have composer installed too
- Clone the repo into your local machine
- create your own mysql db
- Open terminal & run those commands
  - cd /path/to/project
  - composer install
  - cp ./.env.example ./.env
  - php artisan key:generate
- Set db config in .env file
- Open terminal again & run those commands
  - php artisan migrate
  - php artisan serve
- Open your browser go to: `localhost:8000` as per the `artisan serve` output

### Run Tests Instructions
open terminal & run this command `php artisan test`
