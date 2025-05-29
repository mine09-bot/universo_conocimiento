<ul class="dropdown-menu">
    <?php foreach ($formatosDisponibles as $ext => $ruta): ?>
        <li>
            <a class="dropdown-item" href="descargaLibros.php?archivo=<?php echo urlencode("{$idLibro}.{$ext}"); ?>">
                <?php echo strtoupper($ext); ?>
            </a>
        </li>
    <?php endforeach; ?>

    <?php if (empty($formatosDisponibles)): ?>
        <li><span class="dropdown-item text-muted">No disponible</span></li>
    <?php endif; ?>
</ul>




function generarMenuFormatos(array $formatosDisponibles, string $idLibro): string {
$html = '<ul class="dropdown-menu">' . PHP_EOL;

    if (!empty($formatosDisponibles)) {
    foreach ($formatosDisponibles as $ext => $ruta) {
    $archivo = urlencode("{$idLibro}.{$ext}");
    $html .= " <li>\n";
        $html .= " <a class=\"dropdown-item\" href=\"descargaLibros.php?archivo={$archivo}\">" . strtoupper($ext) . "</a>\n";
        $html .= " </li>\n";
    }
    } else {
    $html .= ' <li><span class="dropdown-item text-muted">No disponible</span></li>' . PHP_EOL;
    }

    $html .= '</ul>' . PHP_EOL;
return $html;
}


<ul class="dropdown-menu">
    <li><a class="dropdown-item" href="#">EPUB</a></li>
    <li><a class="dropdown-item" href="#">PDF</a></li>
    <li>
        <hr class="dropdown-divider" />
    </li>
    <li><a class="dropdown-item" href="#">Otra acción</a></li>
</ul>