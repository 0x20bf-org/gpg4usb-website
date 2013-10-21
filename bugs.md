---
layout: default
title: known bugs
description: known bugs in gpg4usb
download-button: true
sources-box: true
---

# Known Bugs

Some bugs we alredy know about and are working on fixing:

##Stable Release (0.3.2-1)

**Exporting private key fails (windows)**
Only the public key is exported when trying to export the private key, if the directory containing the gpg4usb directory contains russian characters. 

**Brakets set wrong for rtl languages**

In some dialogs brakets are set wrong for rtl languages

**Error dialog shown when hitting cancel in export private key dialog**

On export of private key: Hit cancel in file dialog => an error dialog is shown

**Remove double line breaks fails**

Remove double line breaks fails, if the text contains a signature

**Entering correct passphrase on second try**

On decrption when entering a wrong passphrase, the second one isn't accepted even if it's correct


##Unstable Release (0.4)

**Textedit not editable after searching string not found**

Search for a string not contained in the current window, then hit escape. Afterwards the editor window isn't editable anymore
