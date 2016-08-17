# Laravel PHP Framework

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

Developed using the framework Laravel, facilitating the maintain and streamline the process of developing.

## API PODCAST

This API was built to be a intermediate between a Mobile App and iTunes API Search Apple and with Feed RSS from Podcasts.

## Documentation

In this first version, just return searches about podcast.

1. Searching podcast in the iTunes Search API

/apipodcast/iTunesSearchAPI/{country}/{term}

{coutry} = BR/US (Country that you want to search podcast)

{term} = The name that you want to seach

Functional Example: http://benjaminstudio.com.br/apipodcast/itunesSearchAPI/BR/513+podcast

2. Retriving top podcasts from iTunes

/apipodcast/itunesGetTopPodcasts

Functional Example: http://benjaminstudio.com.br/apipodcast/itunesGetTopPodcasts

3. Retriving information from Feed RSS Podcast in JSON Format.

/apipodcast/readFeed?feedUrl={url without http://}

Functional Example: http://benjaminstudio.com.br/apipodcast/readFeed?feedUrl=feeds.feedburner.com/513-podcast