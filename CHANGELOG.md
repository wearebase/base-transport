# Changelog

## v1.0.13 - 2015-06-02

### Additions

- Add direction to Stop

## v1.0.12 - 2015-02-12

### Additions

- Create BoundingBox from a centre point and distance

## v1.0.11 - 2014-11-12

### Fixes

- Default favourite place feature property names on normalization

## v1.0.8 - 2014-10-14

### Fixes

- Widen dependency of Symfony components

## v1.0.7 - 2014-10-10

*** Retag of v1.0.7 ***

## v1.0.7 - 2014-10-08

### Additions

- Validation for Favourite Places

## v1.0.6 - 2014-10-07

### Fixes

- Duplicated fields in Stop normalizer for BC with existing Android apps

## v1.0.5 - 2014-10-01

### Fixes

- FavouritePlace denormalization will not fail with lack of coordinates
- Upped the minimum stability of the Composer dependencies

## v1.0.4 - 2014-09-29

### Fixes

- FavouritePlace will be returned will null for central feature if non exists

## v1.0.3 - 2014-09-17

### Additions

- BusService entity and normalizer

## v1.0.2 - 2014-09-08

### Additions

- Static constructor createFromArray on Stop
- FavouritePlace normalizer calls Stop normalizer instead of constructing manually

## v1.0.1 - 2014-08-27

### Breakages

- Key for FavouriteServices extension is new "favouriteBusServices" (non-API)

### Additions

- TransportNormalizer for handling FavouritePlace, AtcoCode and Stop entities
- BusServiceCode entity created
- FavouritePlace entity now has ID, location, and permanent properties
- Stop entity created as hydrated form of AtcoCode entity

### Fixes

- FavouritePlace entity uses Geospatial interfaces

## v1.0 - 2014-08-13

Initial tagged release.
