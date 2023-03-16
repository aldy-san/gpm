<div class="page-heading">
    <div class="page-title">
        <div class="d-flex justify-content-between align-items-end">
            <div class="col-6 mb-3">
                <h3><?= $title ?></h3>
            </div>
            <div class="btn-group dropdown me-2">
                <button type="button" class="btn btn-outline-primary">Periode</button>
                <button id="period-title" type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                    <span class="sr-only"><?= $current_period['name'] ?></span>
                </button>
                <div class="dropdown-menu mt-2 shadow-sm">
                    <!--<button class="dropdown-item" onclick="executeGraphic(0,1,'tes',true)">tes</button>-->
                    <?php foreach($period as $p): ?>
                    <button onclick="changePeriod('<?= $p['id'] ?>')" class="dropdown-item"><?= $p['name']; ?></button>
                    <?php endforeach; ?>
                </div>
                <div class="form-group ms-3">
                    <input onkeydown="search(this)" type="text" class="form-control" id="searchName" name="search"
                        placeholder="Search Name">
                </div>
            </div>
        </div>
        <section class="section mt-3">
            <div class="card">
                <div class="card-body overflow-auto">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <?php if($title === 'Kategori Survei' ) : ?>
                                <th class="text-capitalize">
                                    No
                                </th>
                                <?php endif ?>
                                <?php foreach ($column_table as $key => $col): ?>
                                <?php if(isset($column_alias)): ?>
                                <?php if($title === 'Kategori Survei' ) : ?>
                                <th class="text-capitalize text-nowrap"><?= $column_alias[$key+1]; ?> </th>
                                <?php else : ?>
                                <th class="text-capitalize text-nowrap"><?= $column_alias[$key]; ?> </th>
                                <?php endif; ?>
                                <?php else : ?>
                                <th class="text-capitalize text-nowrap"><?= join(' ', explode('_', $col)); ?></th>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data_table as $index => $item): ?>
                            <tr>
                                <?php if($title === 'Kategori Survei' ) : ?>
                                <td class="text-capitalize">
                                    <?= $index+1 ?>
                                </td>
                                <?php endif ?>
                                <?php foreach ($column_table as $col): ?>
                                <?php if(isset($column_badge) && in_array($col, $column_badge)): ?>
                                <td class="text-capitalize">
                                    <span
                                        class="<?= $item[$col] === 'Ya' ? 'badge bg-success' : 'badge bg-danger'; ?>"><?= $item[$col] ?></span>
                                </td>
                                <?php else : ?>
                                <td class="text-capitalize">
                                    <?= $item[$col] ?>
                                </td>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?= $this->pagination->create_links(); ?>
                </div>
            </div>
        </section>
    </div>
    <script type="text/javascript" src="<?= base_url('assets/vendors/toastify/toastify.js'); ?>"></script>
    <script type="text/javascript">
    function search(ele) {
        if (event.key === 'Enter') {
            console.log(urlHandler())
            window.location = urlHandler() + "&search=" + ele.value;
        }
    }

    function changePeriod(ele) {
        console.log(urlHandler())
        window.location = urlHandler() + "?period=" + ele;
    }

    function urlHandler() {
        var url = window.location.href
        if (url.split('/')[8].split('?')[0]) {
            // console.log(url.split('/')[8].split('?'))
            url = url.split('/')
            temp = url[8].split('?')
            temp.shift()
            url[8] = "?" + temp.join('')
            // url[8].split('?').shift()
        } else {
            return url
        }
        url = url.join('/')
        return url
    }
    </script>
