<body class="sb-nav-fixed">
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
                                <a class="nav-link" href="<?php echo URL; ?>openPages/openGeneral">Generale</a>
                                <a class="nav-link" href="<?php echo URL; ?>openPages/openClassroom">Aule</a>
                                <a class="nav-link" href="<?php echo URL; ?>openPages/openClass">Classi</a>
                                <a class="nav-link" style="color:white">Docenti</a>
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
                    <h1 class="mt-4">Gestione docenti</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="<?php echo URL; ?>openPages/openHome">Home</a></li>
                        <li class="breadcrumb-item active">Docenti</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-body">
                            Aggiungi un docente e le sue ore di progetti.
                        </div>
                    </div>

                    <form>
                        <!-- info docente, 2 righe-->
                        <div class="row mb-4">
                            <h5>Informazioni docente</h5>
                            <hr>
                            <div class="col">
                                <div class="form-outline">
                                    <label class="form-label" for="name">Nome</label>
                                    <input type="text" id="name" class="form-control" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-outline">
                                    <label class="form-label" for="lastname">Cognome</label>
                                    <input type="text" id="lastname" class="form-control" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-outline">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="email" id="email" class="form-control"
                                        placeholder="example@edu.ti.ch" />
                                </div>
                            </div>

                        </div>
                        <br>
                        <h5>Inserisci le ore di progetto del docente</h5>
                        <hr>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" style="width:5%">ORE</th>
                                    <th scope="col">Lunedì</th>
                                    <th scope="col">Martedì</th>
                                    <th scope="col">Mercoledì</th>
                                    <th scope="col">Giovedì</th>
                                    <th scope="col">Venerdì</th>

                                </tr>
                            </thead>
                            <tr>

                                <th scope="row"><span class="align-top">08:20</span><br><br><span
                                        class="align-bottom">09:05</span></th>

                                <td style="padding:0%"><span name="unselected" class="btnTable" id="1.1"
                                        onclick="colorBtn('1.1')" style="background: white;"></span></td>
                                <td style="padding:0%"><span name="unselected" class="btnTable" id="2.1"
                                        onclick="colorBtn('2.1')" style="background: white;"></span></td>
                                <td style="padding:0%"><span name="unselected" class="btnTable" id="3.1"
                                        onclick="colorBtn('3.1')" style="background: white;"></span></td>
                                <td style="padding:0%"><span name="unselected" class="btnTable" id="4.1"
                                        onclick="colorBtn('4.1')" style="background: white;"></span></td>
                                <td style="padding:0%"><span name="unselected" class="btnTable" id="5.1"
                                        onclick="colorBtn('5.1')" style="background: white;"></span></td>


                            </tr>
                            <tr>
                                <th scope="row"><span class="align-top">09:05</span><br><br><span
                                        class="align-bottom">10:05</span></th>
                                <td style="padding:0%"><span class="btnTable" id=1.2 onclick="colorBtn('1.2')"
                                        style="background: white;"></span></td>
                                <td style="padding:0%"><span class="btnTable" id=2.2 onclick="colorBtn('2.2')"
                                        style="background: white;"></span></td>
                                <td style="padding:0%"><span class="btnTable" id=3.2 onclick="colorBtn('3.2')"
                                        style="background: white;"></span></td>
                                <td style="padding:0%"><span class="btnTable" id=4.2 onclick="colorBtn('4.2')"
                                        style="background: white;"></span></td>
                                <td style="padding:0%"><span class="btnTable" id=5.2 onclick="colorBtn('5.2')"
                                        style="background: white;"></span></td>
                            </tr>
                            <tr>
                                <th scope="row"><span class="align-top">10:05</span><br><br><span
                                        class="align-bottom">10:50</span></th>
                                <td style="padding:0%"><span class="btnTable" id="1.3" onclick="colorBtn('1.3')"
                                        style="background: white;"></span></td>
                                <td style="padding:0%"><span class="btnTable" id="2.3" onclick="colorBtn('2.3')"
                                        style="background: white;"></span></td>
                                <td style="padding:0%"><span class="btnTable" id="3.3" onclick="colorBtn('3.3')"
                                        style="background: white;"></span></td>
                                <td style="padding:0%"><span class="btnTable" id="4.3" onclick="colorBtn('4.3')"
                                        style="background: white;"></span></td>
                                <td style="padding:0%"><span class="btnTable" id="5.3" onclick="colorBtn('5.3')"
                                        style="background: white;"></span></td>
                            </tr>
                            <tr>
                                <th scope="row"><span class="align-top">10:50</span><br><br><span
                                        class="align-bottom">11:35</span></th>
                                <td style="padding:0%"><span class="btnTable" id="1.4" onclick="colorBtn('1.4')"
                                        style="background: white;"></span></td>
                                <td style="padding:0%"><span class="btnTable" id="2.4" onclick="colorBtn('2.4')"
                                        style="background: white;"></span></td>
                                <td style="padding:0%"><span class="btnTable" id="3.4" onclick="colorBtn('3.4')"
                                        style="background: white;"></span></td>
                                <td style="padding:0%"><span class="btnTable" id="4.4" onclick="colorBtn('4.4')"
                                        style="background: white;"></span></td>
                                <td style="padding:0%"><span class="btnTable" id="5.4" onclick="colorBtn('5.4')"
                                        style="background: white;"></span></td>
                            </tr>
                            <tr>
                                <th scope="row"><span class="align-top">11:35</span><br><br><span
                                        class="align-bottom">12:30</span></th>
                                <td style="padding:0%"><span class="btnTable" id="1.5" onclick="colorBtn('1.5')"
                                        style="background: white;"></span></td>
                                <td style="padding:0%"><span class="btnTable" id="2.5" onclick="colorBtn('2.5')"
                                        style="background: white;"></span></td>
                                <td style="padding:0%"><span class="btnTable" id="3.5" onclick="colorBtn('3.5')"
                                        style="background: white;"></span></td>
                                <td style="padding:0%"><span class="btnTable" id="4.5" onclick="colorBtn('4.5')"
                                        style="background: white;"></span></td>
                                <td style="padding:0%"><span class="btnTable" id="5.5" onclick="colorBtn('5.5')"
                                        style="background: white;"></span></td>
                            </tr>
                            <tr>
                                <th scope="row"><span class="align-top">12:30</span><br><br><span
                                        class="align-bottom">13:15</span></th>
                                <td style="padding:0%"><span class="btnTable" id="1.6" onclick="colorBtn('1.6')"
                                        style="background: white;"></span></td>
                                <td style="padding:0%"><span class="btnTable" id="2.6" onclick="colorBtn('2.6')"
                                        style="background: white;"></span></td>
                                <td style="padding:0%"><span class="btnTable" id="3.6" onclick="colorBtn('3.6')"
                                        style="background: white;"></span></td>
                                <td style="padding:0%"><span class="btnTable" id="4.6" onclick="colorBtn('4.6')"
                                        style="background: white;"></span></td>
                                <td style="padding:0%"><span class="btnTable" id="5.6" onclick="colorBtn('5.6')"
                                        style="background: white;"></span></td>
                            </tr>
                            <tr>
                                <th scope="row"><span class="align-top">13:15</span><br><br><span
                                        class="align-bottom">14:00</span></th>
                                <td style="padding:0%"><span class="btnTable" id="1.7" onclick="colorBtn('1.7')"
                                        style="background: white;"></span></td>
                                <td style="padding:0%"><span class="btnTable" id="2.7" onclick="colorBtn('2.7')"
                                        style="background: white;"></span></td>
                                <td style="padding:0%"><span class="btnTable" id="3.7" onclick="colorBtn('3.7')"
                                        style="background: white;"></span></td>
                                <td style="padding:0%"><span class="btnTable" id="4.7" onclick="colorBtn('4.7')"
                                        style="background: white;"></span></td>
                                <td style="padding:0%"><span class="btnTable" id="5.7" onclick="colorBtn('5.7')"
                                        style="background: white;"></span></td>
                            </tr>
                            <tr>
                                <th scope="row"><span class="align-top">14:00</span><br><br><span
                                        class="align-bottom">15:00</span></th>
                                <td style="padding:0%"><span class="btnTable" id="1.8" onclick="colorBtn('1.8')"
                                        style="background: white;"></span></td>
                                <td style="padding:0%"><span class="btnTable" id="2.8" onclick="colorBtn('2.8')"
                                        style="background: white;"></span></td>
                                <td style="padding:0%"><span class="btnTable" id="3.8" onclick="colorBtn('3.8')"
                                        style="background: white;"></span></td>
                                <td style="padding:0%"><span class="btnTable" id="4.8" onclick="colorBtn('4.8')"
                                        style="background: white;"></span></td>
                                <td style="padding:0%"><span class="btnTable" id="5.8" onclick="colorBtn('5.8')"
                                        style="background: white;"></span></td>
                            </tr>
                            <tr>
                                <th scope="row"><span class="align-top">15:00</span><br><br><span
                                        class="align-bottom">15:45</span></th>
                                <td style="padding:0%"><span class="btnTable" id="1.9" onclick="colorBtn('1.9')"
                                        style="background: white;"></span></td>
                                <td style="padding:0%"><span class="btnTable" id="2.9" onclick="colorBtn('2.9')"
                                        style="background: white;"></span></td>
                                <td style="padding:0%"><span class="btnTable" id="3.9" onclick="colorBtn('3.9')"
                                        style="background: white;"></span></td>
                                <td style="padding:0%"><span class="btnTable" id="4.9" onclick="colorBtn('4.9')"
                                        style="background: white;"></span></td>
                                <td style="padding:0%"><span class="btnTable" id="5.9" onclick="colorBtn('5.9')"
                                        style="background: white;"></span></td>
                            </tr>
                            <tr>
                                <th scope="row"><span class="align-top">15:45</span><br><br><span
                                        class="align-bottom">16:30</span></th>
                                <td style="padding:0%"><span class="btnTable" id="1.10" onclick="colorBtn('1.10')"
                                        style="background: white;"></span></td>
                                <td style="padding:0%"><span class="btnTable" id="2.10" onclick="colorBtn('2.10')"
                                        style="background: white;"></span></td>
                                <td style="padding:0%"><span class="btnTable" id="3.10" onclick="colorBtn('3.10')"
                                        style="background: white;"></span></td>
                                <td style="padding:0%"><span class="btnTable" id="4.10" onclick="colorBtn('4.10')"
                                        style="background: white;"></span></td>
                                <td style="padding:0%"><span class="btnTable" id="5.10" onclick="colorBtn('5.10')"
                                        style="background: white;"></span></td>
                            </tr>
                            </tbody>
                        </table>
                        <span class="btn btn-primary col-sm-2" onclick="wrapData('teacher')">Aggiungi docente</span>
                    </form><br><br>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Docenti aggiunti
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Office</th>
                                        <th>Age</th>
                                        <th>Start date</th>
                                        <th>Salary</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Office</th>
                                        <th>Age</th>
                                        <th>Start date</th>
                                        <th>Salary</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <tr>
                                        <td>Tiger Nixon</td>
                                        <td>System Architect</td>
                                        <td>Edinburgh</td>
                                        <td>61</td>
                                        <td>2011/04/25</td>
                                        <td>$320,800</td>
                                    </tr>
                                    <tr>
                                        <td>Garrett Winters</td>
                                        <td>Accountant</td>
                                        <td>Tokyo</td>
                                        <td>63</td>
                                        <td>2011/07/25</td>
                                        <td>$170,750</td>
                                    </tr>
                                    <tr>
                                        <td>Ashton Cox</td>
                                        <td>Junior Technical Author</td>
                                        <td>San Francisco</td>
                                        <td>66</td>
                                        <td>2009/01/12</td>
                                        <td>$86,000</td>
                                    </tr>
                                    <tr>
                                        <td>Cedric Kelly</td>
                                        <td>Senior Javascript Developer</td>
                                        <td>Edinburgh</td>
                                        <td>22</td>
                                        <td>2012/03/29</td>
                                        <td>$433,060</td>
                                    </tr>
                                    <tr>
                                        <td>Airi Satou</td>
                                        <td>Accountant</td>
                                        <td>Tokyo</td>
                                        <td>33</td>
                                        <td>2008/11/28</td>
                                        <td>$162,700</td>
                                    </tr>
                                    <tr>
                                        <td>Brielle Williamson</td>
                                        <td>Integration Specialist</td>
                                        <td>New York</td>
                                        <td>61</td>
                                        <td>2012/12/02</td>
                                        <td>$372,000</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>