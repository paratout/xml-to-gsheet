# Coding Task - Spreadsheet

## Goal
We would like to see a command-line program, based on the Symfony CLI component (​https://symfony.com/doc/current/components/console.html​). The program should process a local or remote XML file and push the data of that XML file to a Google Spreadsheet via the Google Sheets API (​https://developers.google.com/sheets/​). Ideally, you deliver this program as an executable Docker container or phar file.

## Specifications
1. The program should read in a local or remote xml file (configurable as a parameter)
2. Authentication against Google API should be configurable
3. Errors should be written to a logfile



## Install
---

1. Clone the repository
2. run the docker network
```
docker-compose up -d --build
```

3. log to the bash
```
docker exec -it php74-container /bin/bash
```
4. Install the dependencies
```
user@machine# cd console-tool
user@machine# symfony composer install
```

## Usage
---
```
symfony console xml-to-gsheet public/coffee_feed.xml -t "custom title"
```


> ## First usage note
> Running the command the first time will provide a link to the console output before any further processing, open it in the browser and then copy the permission key from the url:
>
> **Example of permission request**
>  ```
> user@machine# symfony console xml-to-gsheet public/coffee_feed.xml -t "custom title"
> user@machine# Open the following link in your browser:
> https://accounts.google.com/o/oauth2/auth?response_type=code&access_type=offline&client_id=890369902087-9qg09jhrlv4sqvoln1b5nuugr973oha3.apps.googleusercontent.com&redirect_uri=http%3A%2F%2Flocalhost%3A8080%2Fgoogle-sheets-api%2Fcallback.php&state&scope=https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fspreadsheets&prompt=select_account%20consent
> user@machine# Enter verification code:
> ```
> **Example of permission url after autorization**
>
> http://localhost:8080/google-sheets-api/callback.php?code=4/0AY0e-g5wErZC1m3bslwT3nlsKvyUSU-1OuLSHbRpgP636dGMqkmt32CoeLOp1uybVvDpDA&scope=https://www.googleapis.com/auth/spreadsheets
>
> The needed part is the _code_ value, in this case, _4/0AY0e-g5wErZC1m3bslwT3nlsKvyUSU-1OuLSHbRpgP636dGMqkmt32CoeLOp1uybVvDpDA_
>
> Back to the console, enter the code and validate it
> ```
> user@machine# Enter verification code: _4/0AY0e-g5wErZC1m3bslwT3nlsKvyUSU-1OuLSHbRpgP636dGMqkmt32CoeLOp1uybVvDpDA_
> ```
> 
> This will create a token.json file that will store the permissions for future use.
>
