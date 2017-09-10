<?php

declare(strict_types=1);

/*
 * This file is part of the humbug/php-scoper package.
 *
 * Copyright (c) 2017 Théo FIDRY <theo.fidry@gmail.com>,
 *                    Pádraic Brady <padraic.brady@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [
    'meta' => [
        'title' => 'Trait declaration',
        // Default values. If not specified will be the one used
        'prefix' => 'Humbug',
        'whitelist' => [],
    ],

    'Declaration in the global namespace: do not do anything.' => <<<'PHP'
<?php

trait A {
    public function a() {}
}

class B {
    use C;
    use D {
        a as protected b;
        c as d;
        e as private;
    }
    use E, F, G {
        E::a insteadof F, G;
        E::b as protected c;
        E::d as e;
        E::f as private;
    }
}
----
<?php

trait A
{
    public function a()
    {
    }
}
class B
{
    use C;
    use D {
        a as protected b;
        c as d;
        e as private;
    }
    use E, F, G {
        E::a insteadof F, G;
        E::b as protected c;
        E::d as e;
        E::f as private;
    }
}

PHP
    ,

    'Declaration in a namespace: prefix the namespace.' => <<<'PHP'
<?php

namespace Foo;

trait A {
    public function a() {}
}

class B {
    use C;
    use D {
        a as protected b;
        c as d;
        e as private;
    }
    use E, F, G {
        E::a insteadof F, G;
        E::b as protected c;
        E::d as e;
        E::f as private;
    }
}
----
<?php

namespace Humbug\Foo;

trait A
{
    public function a()
    {
    }
}
class B
{
    use C;
    use D {
        a as protected b;
        c as d;
        e as private;
    }
    use E, F, G {
        E::a insteadof F, G;
        E::b as protected c;
        E::d as e;
        E::f as private;
    }
}

PHP
    ,

    'Declaration of a whitelisted namespaced trait: prefix the namespace (whitelists works only on classes).' => [
        'whitelist' => ['Foo\A'],
        'payload' => <<<'PHP'
<?php

namespace Foo;

trait A {
    public function a() {}
}

class B {
    use C;
    use D {
        a as protected b;
        c as d;
        e as private;
    }
    use E, F, G {
        E::a insteadof F, G;
        E::b as protected c;
        E::d as e;
        E::f as private;
    }
}
----
<?php

namespace Humbug\Foo;

trait A
{
    public function a()
    {
    }
}
class B
{
    use C;
    use D {
        a as protected b;
        c as d;
        e as private;
    }
    use E, F, G {
        E::a insteadof F, G;
        E::b as protected c;
        E::d as e;
        E::f as private;
    }
}

PHP
        ],

    'Multiple declarations in different namespaces: prefix each namespace.' => <<<'PHP'
<?php

namespace X {
    trait XA
    {
        public function a()
        {
        }
    }
    class XB
    {
        use C;
        use D {
            a as protected b;
            c as d;
            e as private;
        }
        use E, F, G {
            E::a insteadof F, G;
            E::b as protected c;
            E::d as e;
            E::f as private;
        }
    }
}

namespace Y {
    trait YA
    {
        public function a()
        {
        }
    }
    class YB
    {
        use C;
        use D {
            a as protected b;
            c as d;
            e as private;
        }
        use E, F, G {
            E::a insteadof F, G;
            E::b as protected c;
            E::d as e;
            E::f as private;
        }
    }
}

namespace Z {
    trait ZA
    {
        public function a()
        {
        }
    }
    class ZB
    {
        use C;
        use D {
            a as protected b;
            c as d;
            e as private;
        }
        use E, F, G {
            E::a insteadof F, G;
            E::b as protected c;
            E::d as e;
            E::f as private;
        }
    }
}
----
<?php

namespace Humbug\X;

trait XA
{
    public function a()
    {
    }
}
class XB
{
    use C;
    use D {
        a as protected b;
        c as d;
        e as private;
    }
    use E, F, G {
        E::a insteadof F, G;
        E::b as protected c;
        E::d as e;
        E::f as private;
    }
}
namespace Humbug\Y;

trait YA
{
    public function a()
    {
    }
}
class YB
{
    use C;
    use D {
        a as protected b;
        c as d;
        e as private;
    }
    use E, F, G {
        E::a insteadof F, G;
        E::b as protected c;
        E::d as e;
        E::f as private;
    }
}
namespace Humbug\Z;

trait ZA
{
    public function a()
    {
    }
}
class ZB
{
    use C;
    use D {
        a as protected b;
        c as d;
        e as private;
    }
    use E, F, G {
        E::a insteadof F, G;
        E::b as protected c;
        E::d as e;
        E::f as private;
    }
}

PHP
    ,
];
