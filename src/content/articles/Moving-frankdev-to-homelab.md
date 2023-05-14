---
slug: moving-frankdev-to-homelab
title: 'Moving Frankdev.io to the HomeLab'
description: Frankdev.io website was moved to my HomeLab. The website runs on a docker container that is managed by Portainer a powerful container management system for Devs.
coverImage: /assets/img/articles/article-1/move_frankdevio_to_homelab_portainer.png
alt: move-frankdevio-to-homelab-portainer
readingTime: 12 min read
navigation: false
createdAt: 2023-05-13T23:00:00:000Z
updatedAt: 2023-05-13T23:00:00:000Z
---


I decided to move the Frankdev.io website to my HomeLab. 

The website was running on a Kubernetes cluster that I have deployed on a Proxmox cluster composed by two servers hosted on [Hetzner](https://www.hetzner.com/). To tell the true the deployment of the Proxmox cluster and the Kubernetes cluster was a amazing experience, I have learned a lot, used Terraform to deploy virtual  machines, ansible to setup the Kubernetes cluster, ansible roles and terraform configuration files with version control and everything running automatically through Azure DevOps pipelines. The cherry on top of the cake was setting up FluxCD to automate the website deployments.

I was living a dream. The only problem is the **75€** a month I spend on the two servers hosted at Hetzner :IconsTwemojiManFacepalmingLightSkinTone. I know it's not that expensive and probably at the end of the day with a Home Lab I will end up spending more money on equipment and electricity, not to mention other issues like the availability of the internet connection.

Well I always wanted a Home Lab and if I am spending more money than anticipated I can always switch to Hetzner again since I have the infrastructure all declared in code.

By the way I would like to say that I have these servers running on Hetzner for over a year without a single incident, so I can only speak well and recommend the use of this cloud.


:ImageLinkContainer{src="/assets/img/articles/article-1/move_frankdevio_to_homelab_diagram.png" alt="HomeLab Diagram" target="_blank" legend="My HomeLab Diagram"}




