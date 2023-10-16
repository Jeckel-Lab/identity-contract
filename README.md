[![Latest Stable Version](https://poser.pugx.org/jeckel-lab/identity-contract/v/stable)](https://packagist.org/packages/jeckel-lab/identity-contract)
[![Total Downloads](https://poser.pugx.org/jeckel-lab/identity-contract/downloads)](https://packagist.org/packages/jeckel-lab/identity-contract)
[![Build Status](https://github.com/jeckel-lab/identity-contract/workflows/validate/badge.svg)](https://github.com/Jeckel-Lab/identity-contract/actions)
[![codecov](https://codecov.io/gh/Jeckel-Lab/identity-contract/branch/main/graph/badge.svg?token=un0NZq3Hui)](https://codecov.io/gh/Jeckel-Lab/identity-contract)
[![Mutation testing badge](https://img.shields.io/endpoint?style=flat&url=https%3A%2F%2Fbadge-api.stryker-mutator.io%2Fgithub.com%2FJeckel-Lab%2Fidentity-contract%2Fmain)](https://dashboard.stryker-mutator.io/reports/github.com/Jeckel-Lab/identity-contract/main)

# Identity-contract

| PHP Version | Package version | 
| ---------- | ---------------- |
| PHP >= 8.2 | v2.0 |
| PHP >= 8.0 | v1.1 |

This package propose abstract classes to manage Identities in DDD projects.

## Features

Builtin typed identities :
- integer based identities
- string based identities
- uuid based identities

Also:
- instance are readonly
- equality test
- request same identity twice return same object

## Usage

**Int Identity**
```PHP
final class CarId extends AbstractIntIdentity {}

$id = CarId::from(25);
```

**UUID Identity**
```PHP
use JeckelLab\IdentityContract\AbstractUuidIdentity;

final class UserId extends AbstractUuidIdentity {}

$id = UserId::from("d2fbc6c0-0497-42f1-8ece-8840641b67f0");

// or

$id = UserId::new();

// Generating twice same identity return same object

$id1 = UserId::from("d2fbc6c0-0497-42f1-8ece-8840641b67f0");
$id2 = UserId::from("d2fbc6c0-0497-42f1-8ece-8840641b67f0");

var_dump($id1 === $id2); // true
```
