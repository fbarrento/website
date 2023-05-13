# FrankDev.io


## Deployment Configuration

The Website is deployed to a environment that has docker and docker compose installed. 

The docker compose file uses two environment variables `IMAGE_TAG` and `PORT`. Depending on the environment were the application is deployed this values can change. The current deployment is made to a staging environment and a production environment and the deployment is configured with Portainer. In the stack of each Portainer environment this values must be set according.
