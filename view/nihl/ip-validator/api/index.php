<?php

namespace Anax\View;
?>
<h1>IP-validator Rest API</h1>
Validera ip-adresser enligt ip4 och ip6.
<h4>Test routes:</h4>
<form action="<?= url("ipvalidator/api")?>" method="POST">
    <input type="text" name="ip" value="172.15.255.255" hidden>
    <button type="submit">Test IPv4-adress 172.15.255.255</button>
</form>
<br>
<form action="<?= url("ipvalidator/api")?>" method="POST">
    <input type="text" name="ip" value="2001:0db8:85a3:0000:0000:8a2e:0370:7334" hidden>
    <button type="submit">Test IPv6-adress 2001:0db8:85a3:0000:0000:8a2e:0370:7334</button>
</form>
<h4>API:</h4>
<p>Testa en IP-adress:</p>
<pre><code>POST /ipvalidator/api
{"ip": "your.ip.address.here"}</code></pre>
<p>Resultat:</p>
<pre><code>{
    "ip": "your.ip.address.here",
    "match": "Adressen är en giltig (ip4|ip6)-adress!",
    "domain": "somedomain.net"
}
</code></pre>
<p>Resultat ej hittat:</p>

<pre><code>{
    "ip": null,
    "match": "Adressen är ej giltig!",
    "domain": null
}
</code></pre>
<h4>Test API:</h4>
<form action="<?= url("ipvalidator/api")?>" method="POST">
    <label for="ip"></label>
    <input type="text" name="ip" value="">
    <button type="submit">Test IP</button>
</form>
