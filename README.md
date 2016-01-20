# Getting Started

A barebones PHP app that makes use of the [Silex](http://silex.sensiolabs.org/) web framework, which can easily be deployed to Heroku.

The purpose of this application is to demonstrate my object oriented skills and ability to define reusable components.

This application supports the [Getting Started with PHP on Heroku](https://devcenter.heroku.com/articles/getting-started-with-php) article - check it out.

## The Exercise:

Attached is a csv file: clips.csv. Your job is to write code that will load in clips.csv and analyze the data against the rules listed below. Your code should output the results into two files; valid.csv will contain a list of clip_ids's that passed the tests and invalid.csv will contain a list of clip_id's that failed the tests. Requirements are to use PHP, utilize the SPL FilterIterator, and handle exceptions if a file cannot be read in or written to.

## Rules:
1. The clip must be public (privacy == anybody)
2. The clip must have over 10 likes and over 200 plays
3. The clip title must be under 30 characters

- Your implementation should demonstrate your object oriented skills and ability to define reusable components.
- Memory usage is an important factor of a well implemented solution to this problem. The lists the program will process may be much larger than the sample provided with the test!

## Deploying

Install the [Heroku Toolbelt](https://toolbelt.heroku.com/).

```sh
$ git clone git@github.com:itsmealex79/code-sample.git # or clone forked itsmealex79/code-sample
$ cd code-sample
$ heroku login
$ heroku apps:create
$ git push heroku master
$ heroku open
```

## Documentation

For more information about using PHP on Heroku, see these Dev Center articles:

- [PHP on Heroku](https://devcenter.heroku.com/categories/php)


## Testing

You can try this out at:
  https://serene-waters-4579.herokuapp.com/valid
  https://serene-waters-4579.herokuapp.com/invalid
