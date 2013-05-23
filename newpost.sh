#!/bin/bash

now=$(date +"%Y-%m-%d")

if [ ! -f _posts/$now-$1.markdown ]; then
    postnow=$(date +"%Y-%m-%d %k:%M:%S")
    touch "_posts/$now-$1.markdown"
    echo "---" > "_posts/$now-$1.markdown"
    echo "layout: post" >> "_posts/$now-$1.markdown"
    echo "title:  \"$1\"" >> "_posts/$now-$1.markdown"
    echo "date:   $postnow" >> "_posts/$now-$1.markdown"
    echo "categories: update" >> "_posts/$now-$1.markdown"
    echo "---" >> "_posts/$now-$1.markdown"
    open _posts/$now-$1.markdown
fi
