# zend-version

> ## ABANDONED
>
> This component existed solely for the purpose of reporting a framework version
> in initial skeleton installations and CLI tooling. When Zend Framework split
> from a monolithic framework into a component library with version 2.5, this
> particular component no longer had a use case, as there is no global framework
> version.
>
> Users are encouraged to use [ocramius/package-versions](https://github.com/Ocramius/PackageVersions)
> instead.

`Zend\Version` provides a class constant `Zend\Version\Version::VERSION` that
contains a string identifying the version number of your Zend Framework
installation. `Zend\Version\Version::VERSION` might contain “2.4.1”, for example.
