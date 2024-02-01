<!--
* SPDX-FileCopyrightText: 2024 Sebastian Stöcker <sebastian.stoecker@uni-marburg.de>
* SPDX-License-Identifier: AGPL-3.0-or-later
-->

# Hook scripts

Scripts in this directory will be picked up by the docker containers
automatically. They can be used for automating setup specific to a developers
use cases

- For all Nextcloud containers:
    - before-install.sh
    - after-install.sh


## Example for before-start.sh
```bash
#!/bin/bash

echo "🤖 triggered hook before-start.sh"
env
export OC_PASS="mycustomuser"
occ user:add --password-from-env mycustomuser
```
