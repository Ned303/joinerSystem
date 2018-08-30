# joinerSystem
Joiner system for software project

## Setting up the project:
### Setup LAMP
This application is made for a lamp server. [How to set up a lamp server](https://howtoubuntu.org/how-to-install-lamp-on-ubuntu)

### Install composer
Run in the `joinerSystem/src` directory:
`php composer.phar install`

### Install ant
`sudo apt-get install ant`

### Create property file
Create a new file in the joinerSystem root directory, you can name this <yourname>.properties. Copy the content of the following into the file and fill in the blank properties.
```
build.dir=.build
dist.dir=dist

deploy.model.dir=/var/www/joinerSystem/models/
deploy.verbose=false
deploy.overwrite=true

src.dir=src
src.model.dir.name=models
src.model.dir=${src.dir}/${src.model.dir.name}

deploy.dir=/var/www/
deploy.distribution.dir=joinerSystem

email.host=
email.username=
email.password=
email.from.address=
email.from.name=

database.driver=Mysqli
database.username=root
database.password=root
database.database=joinerSystem
database.hostname=localhost

local.url=http://localhost/joinerSystem
```

Set the `buildprops` property in build.xml to your property file

## Deploy project
In root joinerSystem folder:
`sudo ant deploy-all`

Access website on http://localhost/joinerSystem/index.php