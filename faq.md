---
layout: default
title: faq
description: frequently asked questions
download-button: true
screenshot-box: true
---

# FAQ

## gpg4usb does not run from usb flash drive on linux

Current linux distributions don't allow running from usb flash drive formmated with FAT

## Sometimes gpg4usb does not start on 64bit linux

You need 32 bit libraries. 

On debian based system these could be installed with

        apt-get install ia32-libs 

On suse these could be installed with

        zypper install 32bit

On Red Hat distributions these could be installed with

        yum install glibc.i686
