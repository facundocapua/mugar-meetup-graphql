# GraphQL Example for MugAR Meetup

**CmsGraphQl** provides type and resolver information for the GraphQl module
to generate cms blocks information endpoints.

## Requirements

* Magento 2.3-develop: https://github.com/magento/magento2/tree/2.3-develop

Optional:
* A GraphQL client, for example: https://altair.sirmuel.design


## Installation
```bash
composer config repositories.mugar-meetup-graphql vcs https://github.com/facundocapua/mugar-meetup-graphql.git
composer require mugar/mugar-meetup-graphql:dev-master
php bin/magento module:enable MugAR_CmsGraphQl
php bin/magento setup:upgrade
```

## Using it

### Getting blocks

```graphql
query{
  blocks(
    block_id:1
  ){
    identifier,
    title,
    content
  }
}
```

## Documentation

```graphql
blocks(
  block_id: Int @Documentation("The block id")
  ){
    block_id: Int @Documentation("Block id")
    identifier: String @Documentation("Block Identifier")
    title: String @Documentation("Block title")
    content: String @Documentation("Block content")
  }
```
