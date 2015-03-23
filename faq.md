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

## Gpg4usb does not start on 64bit linux

You need to install 32-bit compatibility libraries: 

On debian based system these can be installed with

        apt-get install ia32-libs 

or (for newer Ubuntu distributions)

	apt-get install ia32-libs-multiarch

On Suse these can be installed with

        zypper install 32bit

On Red Hat distributions these can be installed with

        yum install glibc.i686

## How to backup all the key files

To backup all your key files, just backup the files keydb/pubring.gpg and keydb/secring.gpg

## How to create a revocation key with gpg4usb

Unfortunately the creation of a revocation certificate is not implemented in the GUI of gpg4usb till now. But you can use the included gpg command line tool to create a revocation certificate. Just open a shell/command prompt, change with cd to the gpg4usb directory and follow these steps:

get your key id (for linux use ./bin/gpg instead):

	./bin/gpg.exe --list-secret-keys --homedir=./keydb

create the revocation certificate (the revocation certificate will be contained in revoke.asc and myuid has to contain your keyid. Again use ./bin/gpg for linux):

	./bin/gpg.exe --homedir=./keydb --output revoke.asc --gen-revoke myuid

## How to change the passphrase of my private key

Unfortunately the change of the passphrase is not implemented in the GUI of gpg4usb till now. But you can use the included gpg command line tool to change the passphrase. Just open a shell/command prompt, change with cd to the gpg4usb directory and follow these steps:

get your key id (for linux use ./bin/gpg instead):

        ./bin/gpg.exe --list-secret-keys --homedir=./keydb

Reset the passphrase (myid contains the id of your key. Use ./bin/gpg for linux instead)

	./bin/gpg.exe --homedir=./keydb --edit-key myid
	gpg> passwd

Now just enter your old passphrase and your new one twice.

