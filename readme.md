## API PODCAST

This API was built to be a intermediate between a Mobile App and iTunes API Search Apple and with Feed RSS from Podcasts.

## Documentation

In this first version, just return searches about podcast.

### Prerequisites

What things you need to run the software?

```
PHP 5.6.* 
Composer
```

### Installing

Open terminal on your apache directory and run the commands below.

```
git clone https://github.com/dyegocruz/apipodcast.git
cd apipodcast
composer install
```

### Running

To run the application access http://localhost/apipodcast on your browner.

1. Searching podcast in the iTunes Search API

http://localhost/apipodcast/iTunesSearchAPI/{country}/{term}

{coutry} = BR/US (Country that you want to search podcast)

{term} = The name that you want to seach

Functional Example: http://benjaminstudio.com.br/apipodcast/itunesSearchAPI/BR/513+podcast

2. Retriving top podcasts from iTunes

http://localhost/apipodcast/itunesGetTopPodcasts

Functional Example: http://benjaminstudio.com.br/apipodcast/itunesGetTopPodcasts

3. Retrieving information from Feed RSS Podcast in JSON Format.

http://localhost/apipodcast/readFeed?feedUrl={url without http://}

Functional Example: http://benjaminstudio.com.br/apipodcast/readFeed?feedUrl=feeds.feedburner.com/513-podcast
