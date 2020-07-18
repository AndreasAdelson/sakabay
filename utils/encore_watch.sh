#!/bin/bash

dir=$(cd -P -- "$(dirname -- "$0")" && pwd -P)
docker-compose restart &
${dir}/../sakabay/node_modules/.bin/encore dev --watch --watch-poll=1000
