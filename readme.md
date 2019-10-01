
# Flashcards

![build status](https://app.chipperci.com/projects/4e62018a-b2e8-4aa5-a1da-277e708b81fe/status/dev "Build Status")

Track domain knowledge across teams with note cards.

### Local Development

This repo ships with docker files you can use to spin up a local development environment:

1. Clone the repository
2. Create an ENV file: `cp .env.example .env`
3. Build the images: `docker-compose build`
4. Install the PHP dependencies: `docker-compose run php composer install`
5. Install the Node dependencies: `docker-composer run node npm install`
6. Compile the front-end assets: `docker-compose run node npm run dev`
7. Launch the development instance: `docker-compose up -d`
8. Run the migrations: `docker-compose exec php php artisan migrate`

NB:

- You must have both Docker and Docker-Compose installed on your host system.
- Check the contents of the `.env` file and make sure you supply the missing values.
- Make sure the ports listed in the  `docker-compose.yml` file are available for use.
- Persistent data generated by the images is stored in the `docker/volumes` directory.


### Resources

- [Laravel Framework](https://laravel.com)
- [Livewire](https://laravel-livewire.com)
- [Tailwind CSS](https://tailwindcss.com)
- [Zondicons](https://www.zondicons.com)
- [Laravel Mix](https://laravel-mix.com/)
- Icon made by [Freepik](https://www.freepik.com/home) from [www.flaticon.com](http://www.flaticon.com/)
