# DEVOM API
#

### Requirements
- Docker

### Install

Download repository
```
git clone [repository]
```
```
cp .env.dist .env
```


Build

The first installation 
```
make build
```

Create database
```
make db
```

### HOW TO RUN 
*Docker:*
UNIT TEST
Run Unit Tests
```
make test
```

Test Coverave
1. run coverage
```
make coverage
```
2. Open report
```
./build/test_results/phpunit/coverage/index.html
```

ACCEPTANCE TEST
```
make build-test
make acceptance 
```


### API DOC

http://localhost:8030/doc/index.html


