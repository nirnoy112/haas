## About This Project

This is a Horoscope-as-a-Service (HaaS) application built using Laravel and MySQL database. The following requirements have beed in this application.

- Generates horoscopes for all 12 Zodiac signs for a given year. Each sign can have from 1 - really shitty day to 10 - super amazing day. Day scores are generated randomly for each day and stored in the database.
- Shows a yearly statistics about which Zodiac sign has the best year (by average daily score).
- Shows a calendar for a given year and Zodiac sign. Days should be colored from #ff0000 (really shitty) to #00ff00 (super amazing).
- Shows the best month on average (by average daily score) for a Zodiac sign in a given year.

- Bonus Point: On hover on a day it shows a sentence that describes what happens to an astrological sign on the day. Sentences are meaningful, non-repetitive and relevant to the score of the day.

## Deploying The Project

- Clone this git repository.

	git clone https://github.com/nirnoy112/haas.git

- Go to project directory and install required dependencies.

	cd haas

- Create .env file, appliacation key and set database credentials in the .env file.

	copy .env.example .env

	php artisan key:generate

- Run database migration and seeding.

	php artisan migrate
	
	php artisan db:seed

- Finally, run the application on the server.

	php artisan serve