# games-manager-frontend

### Requirements
- Directus Backend
- Discord App (OAuth) 

### Configuration
| Parameter | Required | Type | Default | Description |
|-----------|----------|------|---------|-------------|
| APP_HOST | yes | string | - | The URL to this service |
| APP_BACKEND | yes | string | - | The URL to the backend service (Directus) |
| APP_BACKEND_AUTH | yes | string | - | The Bearer token for the Directus user, format `Bearer xxxxxxxxxxxxxxxxxxxx` |
|    DISCORD_CLIENT_ID    |   yes    | string |    -    |                                       Discord App Client ID                                        |
|  DISCORD_CLIENT_SECRET  |   yes    | string |    -    |                                     Discord App Client Secret                                      |
| DEBUG | no | bool | - | Enables PHP debug logging |