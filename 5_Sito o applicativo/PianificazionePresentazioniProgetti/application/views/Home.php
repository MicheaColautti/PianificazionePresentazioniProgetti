<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html">GPP - Home</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Pianificazione</div>
                        <a class="nav-link" href="#" style="color:white">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Visualizza pianificazione
                        </a>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Sezione gestore
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?php echo URL; ?>openPages/openGeneral">Generale</a>
                                <a class="nav-link" href="<?php echo URL; ?>openPages/openClassroom">Aule</a>
                                <a class="nav-link" href="<?php echo URL; ?>openPages/openClass">Classi</a>
                                <a class="nav-link" href="<?php echo URL; ?>openPages/openTeachers">Docenti</a>
                                <a class="nav-link" href="<?php echo URL; ?>openPages/openStudents">Studenti</a>
                            </nav>
                        </div>
                        <div class="sb-sidenav-footer">
                            <div class="small">CPT Trevano</div>
                        </div>
                    </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4"> Gestione pianificazioni presentazioni</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Home</li>
                    </ol>


                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Pianificazione presentazioni
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>

                                    <tr>
                                        <th>Data</th>
                                        <th>Orario Inizio</th>
                                        <th>Orario Fine</th>
                                        <th>Aula</th>
                                        <th>Allievo</th>
                                        <th>Classe</th>
                                        <th>Docente</th>
                                        <th>Docente</th>
                                        <th>Progetto</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <script>
                                        var table = localStorage.getItem("table");
                                        document.write(table);
                                    </script>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>