#!/bin/bash

scss -t compressed cpu26/scripts/style.css cpu26/style.css
echo "ça marche pas ? passer par cssnano https://cssnano.github.io/cssnano/playground/"

java -jar /usr/share/java/closure-compiler.jar \
    --compilation_level SIMPLE_OPTIMIZATIONS \
    --js cpu26/scripts/interactions.js \
        --language_in ECMASCRIPT_2017 \
    --js_output_file cpu26/interactions.js \
        --language_out ECMASCRIPT5_STRICT