#!/bin/bash
if [ "$TRAVIS_BRANCH" == "master" ]; then
  curl -X POST ${PLOI_PRODUCTION_URL}
fi