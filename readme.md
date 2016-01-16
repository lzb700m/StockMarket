#StockMarket Web Application

This is the course project for CS6314 Web Programming Language class of Fall 2015. The task is to design and implement a stock trade web application using modern web development language / frameworks that has the following basic functions:

- User management (sign up, log in and session management)
- Present available market information and stock detail information to user
- User account management (watchlist, buy / sell, portfolio, transaction history)
- Admin user has its own interface for managing the web application

StockMaket web application is designed to allow registered user to check current market statistics, current and historical data of any single stock, add / remove any single stock into / from user’s watchlist and buy / sell any stock. This application uses the real live stock data provided by Yahoo Finance web service. The design of this application is based on the following assumptions:

- Registered user is allowed to buy / sell stock 24 hours a day, 7 days a week. This is normally not the case with a real stock broker. In real life, trade is only allowed during the market trade hours.
- Registered user is allowed to buy / sell any amount of shares (greater or equal to 1). In real life, market may have different limitations on the amount of shares to trade.
- As the application does not have a payment function implemented, upon registration, each user will be granted $10, 000 virtual dollars to start with. This is certainly not the real life experience.

This application is implemented with PHP and MySQL. To host the application, you will need an Apache, MySQL, and PHP server, or simply install MAMP or WAMP on your machine to host it. Database schema can be created using the scripts in ./sql/dump.sql.

Have fun.

