# Test runner


### Install and run
After clone run command `start`. This command build all docker containers and than run it all.
```
./start
```

After that, you have to add opportunity that can run composer via php docker container.
How to do that you can see by link below.
[How to add execution composer via php docker](doc/add-composer-docker.md "How to add execution composer via php docker").

#### Run migrations
Install migrations
```
./console migrations:install
```
Run migrations
```
./console migrations:run-all
```

#### Access via browser
[http://localhost:39085](http://localhost:39085/)