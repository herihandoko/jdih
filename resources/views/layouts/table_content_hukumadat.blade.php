<table class="shadow table table-striped">


    <tbody>
        <?php
        $i = 1;
        ?>
        @foreach($hukumadatregulasiDetail->where('materi_type', 2) as $material)
        <?php
        if ($i == 1) {
            echo '<tr>
            <td>Regulasi</td>
            <td>:</td>
            <td>
            <a href="' . asset('storage/places/materi_hukumadat/' . $material->materi_file) . '" target="_blank">
            ' . $i . '. ' . $material->materi_file . '
            </a>
            </td>
        </tr>';
        } else {
            echo '<tr>
            <td></td>
            <td>:</td>
            <td>
            <a href="' . asset('storage/places/materi_hukumadat/' . $material->materi_file) . '" target="_blank">
            ' . $i . '. ' . $material->materi_file . '
            </a>
            </td>
        </tr>';
        }
        $i++
        ?>
        @endforeach

        <!-- refrensi -->
        <?php
        $i = 1;
        ?>
        @foreach($hukumadatregulasiDetail->where('materi_type', 3) as $material)
        <?php
        if ($i == 1) {
            echo '<tr>
            <td>Refrensi</td>
            <td>:</td>
            <td>
            <a href="' . asset('storage/places/materi_hukumadat/' . $material->materi_file) . '" target="_blank">
            ' . $i . '. ' . $material->materi_file . '
            </a>
            </td>
        </tr>';
        } else {
            echo '<tr>
            <td></td>
            <td>:</td>
            <td>
            <a href="' . asset('storage/places/materi_hukumadat/' . $material->materi_file) . '" target="_blank">
            ' . $i . '. ' . $material->materi_file . '
            </a>
            </td>
        </tr>';
        }
        $i++
        ?>
        @endforeach

        <!-- dokumentasi -->
        <?php
        $i = 1;
        ?>
        @foreach($hukumadatregulasiDetail->where('materi_type', 4) as $material)
        <?php
        if ($i == 1) {
            echo '<tr>
            <td>Dokumentasi</td>
            <td>:</td>
            <td>
            <a href="' . asset('storage/places/materi_hukumadat/' . $material->materi_file) . '" target="_blank">
            ' . $i . '. ' . $material->materi_file . '
            </a>
            </td>
        </tr>';
        } else {
            echo '<tr>
            <td></td>
            <td>:</td>
            <td>
            <a href="' . asset('storage/places/materi_hukumadat/' . $material->materi_file) . '" target="_blank">
            ' . $i . '. ' . $material->materi_file . '
            </a>
            </td>
        </tr>';
        }
        $i++
        ?>
        @endforeach

        <!-- link -->
        <?php
        $i = 1;
        ?>
        @foreach($hukumadatregulasiDetail->where('materi_type', 5) as $material)
        <?php
        if ($i == 1) {
            echo '<tr>
            <td>Link</td>
            <td>:</td>
            <td>
            <a href="' . $material->materi_file . '" target="_blank">
            ' . $i . '. ' . $material->materi_file . '
            </a>
            </td>
        </tr>';
        } else {
            echo '<tr>
            <td></td>
            <td>:</td>
            <td>
            <a href="' . $material->materi_file . '" target="_blank">
            ' . $i . '. ' . $material->materi_file . '
            </a>
            </td>
        </tr>';
        }
        $i++
        ?>
        @endforeach
    </tbody>
</table>