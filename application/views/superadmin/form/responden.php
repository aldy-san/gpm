<div class="page-heading">
    <div class="page-title">
        <div class="d-flex justify-content-between align-items-end">
            <div class="col-3 mb-3">
                <h3><?= $title ?></h3>
            </div>
            <div class="d-flex ">
                <div class="btn-group dropdown me-2 mb-auto">
                    <button type="button" class="btn btn-outline-primary">Periode</button>
                    <button id="period-title" type="button"
                        class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false" data-reference="parent">
                        <span class="sr-only"><?= $current_period['name'] ?></span>
                    </button>
                    <div class="dropdown-menu mt-2 shadow-sm">
                        <!--<button class="dropdown-item" onclick="executeGraphic(0,1,'tes',true)">tes</button>-->
                        <?php foreach($period as $p): ?>
                        <button onclick="changePeriod('<?= $p['id'] ?>')"
                            class="dropdown-item"><?= $p['name']; ?></button>
                        <?php endforeach; ?>
                    </div>
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
            window.location = updateQueryStringParameter(urlHandler(), 'search', ele.value)
        }
    }

    function changePeriod(val) {
        const url = updateQueryStringParameter(urlHandler(), 'period', val)
        window.location = url.includes('search=') ? removeURLParameter(url, 'search') : url
    }

    function urlHandler() {
        var url = window.location.href
        if (url.split('/')[8].split('?')[0]) {
            url = url.split('/')
            temp = url[8].split('?')
            temp.shift()
            url[8] = "?" + temp.join('')
        } else {
            return url
        }
        url = url.join('/')
        return url
    }


    function updateQueryStringParameter(uri, key, value) {
        var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
        var separator = uri.indexOf('?') !== -1 ? "&" : "?";
        if (uri.match(re)) {
            return uri.replace(re, '$1' + key + "=" + value + '$2');
        } else {
            return uri + separator + key + "=" + value;
        }
    }

    function removeURLParameter(url, parameter) {
        //prefer to use l.search if you have a location/link object
        var urlparts = url.split('?');
        if (urlparts.length >= 2) {

            var prefix = encodeURIComponent(parameter) + '=';
            var pars = urlparts[1].split(/[&;]/g);

            //reverse iteration as may be destructive
            for (var i = pars.length; i-- > 0;) {
                //idiom for string.startsWith
                if (pars[i].lastIndexOf(prefix, 0) !== -1) {
                    pars.splice(i, 1);
                }
            }

            return urlparts[0] + (pars.length > 0 ? '?' + pars.join('&') : '');
        }
        return url;
    }
    </script>