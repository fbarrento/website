---
title: 'Moving Frankdev.io to my HomeLab'
description: I decided to move the Frankdev.io website to my HomeLab. This way while I'm learning about
navigation: false
---

# Moving Frankdev.io to my Homelab

I decided to move the Frankdev.io website to my HomeLab. 

The website was running on a Kubernetes cluster that I have deployed on a Proxmox cluster composed by two servers hosted on [Hetzner](https://www.hetzner.com/). To tell the true the deployment of the Proxmox cluster and the Kubernetes cluster was a amazing experience, I have learned a lot, used Terraform to deploy virtual  machines, ansible to setup the Kubernetes cluster, ansible roles and terraform configuration files with version control and everything running automatically through Azure DevOps pipelines. The cherry on top of the cake was setting up FluxCD to automate the website deployments.

I was living a dream. The only problem is the **75€** a month I spend on the two servers hosted at Hetzner. I know it's not that expensive and probably at the end of the day with a Home Lab I will end up spending more money on equipment and electricity, not to mention other issues like the availability of the internet connection.

Well I always wanted a Home Lab and if I am spending more money than anticipated I can always switch to Hetzner again since I have the infrastructure all declared in code.

By the way I would like to say that I have these servers running on Hetzner for over a year without a single incident, so I can only speak well and recommend the use of this cloud.

In my Home Lab I have three machines running: 


|Name | **Home maid server (production machine)** |
|--|--|
|Memory|32 GB|
|CPU|AMD Ryzen 5 5600G processor with Radeon graphics|
|Storage| 1TB nvme |
|Storage| 4x4TB Western Digital HDD |

|Name |**Lenovo ThinkStation (Preparation machine)**|
|--|--|
|Memory|16 GB|
|CPU|Intel(R) Xeon(R) CPU E31230 @ 3.20GHz (8 threads)|
|Storage| 256GB SDD |
|Storage| 2x1TB Western Digital HDD |

|Name |**Raspberry PI 4 8GB**|
|--|--|

Added a new pipeline to trigger on release branches or to tag the image on a different way

Adding docker compose files

Create a new Stack on Portainer
