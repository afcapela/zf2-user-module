ZF2 User Module Concept
=======================
Version 0.0.1 Created by Evan Coury

Introduction
------------
This is an exmple of how a "user" module could work in Zend Framework 2. This is
not **the** user module, or how it **will** work; it's just an example to help
me think through different module use-cases. This is pre-beta, pre-alpha,
not-fit-for-use-in-any-way-shape-or-form code!

Stuff to figure out
-------------------
Some of this may be stuff we leave outside of the scope of ZF2 and up to module
developers, but it's worth mentioning it all, none-the-less. In those cases, it
may still be good to provide examples or suggestions for best practices. This
list does _not_ contain any proposals for solutions. Please check the ZF2 wiki
and ZF-Contributors mailing list; as there have been many suggestions and
discussions proposing solutions to some of the issues listed below.

* **Overall**
    * How can modules cleanly "share" resources? For example, you have 5 modules
    which all use a database connection (or maybe two: master for writes, slave 
    for reads).
* **Installation**
    * Importing DB Schema
    * "Merging/compiling" of config (routes, di config, etc) to save cycles at runtime.
    * Making static assets publically available
    * Resolving dependencies
* **Upgrades**
    * DB migrations
    * Replacement of assets, merged config values (routes, di, etc)
    * How to handle (or not handle) if assets/config values have been changed/modified?
* **Uninstallation**
    * What's removed, what should stay?
    * Removal of "merged/compiled-in" config values. How to tell if a config
      value has been overridden / changed by another module? What to do then?
    * Should it dheck for other modules that are depending on it? How much is
      too much, and when do we just leave it up to the developers?
