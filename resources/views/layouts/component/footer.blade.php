<?php
/**
 * It have many bugs
 * Created in dreaming.
 * User: Boxjan
 * Datetime: 2019-05-02 18:48
 */
?>
<footer class="inline">
    <p>© 2019 - {{config('app.name')}} -
        <a href="https://github.com/sdibtacm/OnlineJudge" target="_blank"> Github </a>
    </p>
    <p>Run in
        {{ printf("%.5f", microtime(true) - LARAVEL_START + 0.005) }}
        seconds with
        {{ $GLOBALS['QUERY_COUNT'] }} queries.
    </p>
    <p>
        Power by <a target="_blank" href="https://laravel.com"> Laravel </a>
    </p>
    <p>
        Designer &amp; Developer by
        <a target="_blank" href="https://boxjan.com"> Boxjan </a>
        &amp;
        <a target="_blank" href="https://github.com/sdibtacm"> SDIBT ACM Team </a>
    </p>
</footer>