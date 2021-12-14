[![Latest Stable Version](https://poser.pugx.org/jeckel-lab/identity-contract/v/stable)](https://packagist.org/packages/jeckel-lab/identity-contract)
[![Total Downloads](https://poser.pugx.org/jeckel-lab/identity-contract/downloads)](https://packagist.org/packages/jeckel-lab/identity-contract)
[![Build Status](https://github.com/jeckel-lab/identity-contract/workflows/validate/badge.svg)](https://github.com/Jeckel-Lab/identity-contract/actions)
[![Mutation testing badge](https://img.shields.io/endpoint?style=flat&url=https%3A%2F%2Fbadge-api.stryker-mutator.io%2Fgithub.com%2FJeckel-Lab%2Fidentity-contract%2Fmain)](https://dashboard.stryker-mutator.io/reports/github.com/Jeckel-Lab/identity-contract/main)

# Identity-contract

**Require PHP >= 8.0**

Propose basic abstract classes to manage Identities in Domain project.

- integer based identities
- string based identities
- uuid based identities

# Usage

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
```

