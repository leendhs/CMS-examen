<?php

use craft\elements\Entry;
use craft\elements\Asset;
use craft\helpers\UrlHelper;

return [
    'endpoints' => [
        '/api/furniture' => function() { //dit is voor heel de section
            return [
                'elementType' => Entry::class,
                'criteria' => ['section' => 'furniture'], //geeft al de sections van news (als je dit weg laat, geeft het alles)
                'cache' => false,
                'serializer' => 'jsonFeed',
                'transformer' => function(Entry $entry) {
                    return [
                        'id' => $entry->id,
                        'title' => $entry->title,
                        'fulltext' => $entry->fulltext,
                        'price' => $entry->price,
                        'rating' => $entry->rating,
                       'bannerImg' => str_replace("https","http",$entry->bannerImage->one()->getUrl()),
                    ];
                },
            ];
        },

        'api/furniture/<entryId:\d+>' => function($entryId) { //dit is voor 1 item specifiek
            return [
                'elementType' => Entry::class,
                'criteria' => ['id' => $entryId],
                'one' => true,
                'cache' => false,
                'serializer' => 'jsonFeed',
                'transformer' => function(Entry $entry) {
                    return [
                        'id' => $entry->id,
                        'title' => $entry->title,
                        'fulltext' => $entry->fulltext,
                        'price' => $entry->price,
                        'rating' => $entry->rating,
                       'bannerImg' => str_replace("https","http",$entry->bannerImage->one()->getUrl()),
                    ];
                },
            ];
        },
    ]
];