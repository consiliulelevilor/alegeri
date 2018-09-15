#!/bin/bash
if [ "$TRAVIS_BRANCH" == "master" ]; then
  curl ${PLOI_PRODUCTION_URL}
fi