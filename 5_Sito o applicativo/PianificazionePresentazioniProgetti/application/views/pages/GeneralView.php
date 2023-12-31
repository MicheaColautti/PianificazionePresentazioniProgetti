<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="index.html">GPP - Home</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
            class="fas fa-bars"></i></button>


    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#!">Logout</a></li>
            </ul>
        </li>
    </ul>
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">

            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Pianificazione</div>
                    <a class="nav-link" href="<?php echo URL; ?>openPages/openHome">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Visualizza pianificazione
                    </a>
                    <a class="nav-link collapsed.open" href="#" data-bs-toggle="collapse"
                        data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Sezione gestore
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse.open" id="collapseLayouts" aria-labelledby="headingOne"
                        data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" style="color:white">Generale</a>
                            <a class="nav-link" href="<?php echo URL; ?>openPages/openClassroom">Aule</a>
                            <a class="nav-link" href="<?php echo URL; ?>openPages/openClass">Classi</a>
                            <a class="nav-link" href="<?php echo URL; ?>openPages/openTeachers">Docenti</a>
                            <a class="nav-link" href="<?php echo URL; ?>openPages/openStudents">Studenti</a>

                        </nav>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">CPT Trevano</div><br>
                    <button type="button" class="btn btn-secondary" onclick="generatePlanning()">Nuova
                        pianificazione</button>
                </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Gestione generale</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="<?php echo URL; ?>openPages/openHome">Home</a></li>
                    <li class="breadcrumb-item active">Generale</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-body">
                        Imposta le informazioni generali della pianificazione.<br>Se vuoi modificare la
                        pianificazione attuale non modificare questa pagina
                    </div>
                </div>

                <form>
                    <!-- info generali, 2 righe-->
                    <div class="row mb-4">
                        <h5>Informazioni anno e sessione</h5>
                        <hr>
                        <div class="col">
                            <div class="form-outline">
                                <label class="form-label" for="year">Anno</label>
                                <input type="text" id="year" class="form-control" placeholder="2022/2023" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <label class="form-label" for="session">Sessione</label>
                                <input type="number" id="session" class="form-control" placeholder="1/2/3/.." min="1"
                                    max="3" />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                                <label class="form-label" for="projManager">Responsabile</label>
                                <input type="text" id="projManager" class="form-control" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <label class="form-label" for="chief">Capo laboratorio</label>
                                <input type="text" id="chief" class="form-control" />
                            </div>
                        </div>
                    </div><br>
                    <div class="row mb-4">
                        <h5>Inizio e fine della pianificazione - MM/GG/AAAA</h5>
                        <hr>
                        <div class="col">
                            <div class="form-outline"></div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <input id="startEnd" class="form-control col-sm-1" type="text" name="daterange"
                                    value="06/02/2023 - 06/20/2023" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline"></div>
                        </div>

                    </div>
                    <br>


                    <span class="btn btn-primary col-sm-2" onclick="wrapData('general')">Salva dati</span>
                </form><br><br>


            </div>
        </main>