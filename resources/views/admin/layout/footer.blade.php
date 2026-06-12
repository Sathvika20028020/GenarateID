<style>
    @media only screen and (max-width: 991.98px) {

        .footer {
            margin-left: 0 !important;
        }
    }

    .changelog-container {
        height: 50vh;
        overflow-y: auto;
        scrollbar-width: thin;
        scrollbar-color: #ccc #f1f1f1;
    }

    .changelog-container::-webkit-scrollbar {
        width: 6px;
    }

    .changelog-container::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 3px;
    }

    .changelog-container::-webkit-scrollbar-thumb {
        background: #ccc;
        border-radius: 3px;
    }

    .changelog-container::-webkit-scrollbar-thumb:hover {
        background: #999;
    }

    .changelog-item {
        border-bottom: 1px solid #e9ecef;
        padding: 15px 0;
        margin-bottom: 10px;
    }

    .changelog-item:last-child {
        border-bottom: none;
    }

    .version-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .version-number {
        font-size: 1.1rem;
        font-weight: 600;
        color: #333;
    }

    .release-date {
        color: #6c757d7a;
        font-size: 0.9rem;
    }

    .latest-badge {
        background-color: #28a745;
        color: white;
        padding: 2px 8px;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 500;
        margin-left: 10px;
    }

    .update-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .update-item {
        padding: 5px 0;
        padding-left: 20px;
        position: relative;
        font-size: 0.9rem;
        color: #555;
    }

    .update-item:before {
        content: "·";
        position: absolute;
        left: 5px;
        color: #007bff;
        font-weight: bold;
    }

    .update-label {
        display: inline-block;
        padding: 2px 6px;
        border-radius: 4px;
        font-size: 0.7rem;
        font-weight: 600;
        margin-right: 8px;
        text-transform: uppercase;
    }

    .label-new {
        background-color: #d4edda;
        color: #155724;
    }

    .label-fix {
        background-color: #f8d7da;
        color: #721c24;
    }
</style>
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 footer-copyright text-center">
                <p class="mb-0">Copyright 2026 © Generate ID </p>
                <p class="mb-0">
                      <span class="fw-bold" style="color: #007bff;" data-bs-toggle="modal" data-bs-target="#exampleModal" style="cursor: pointer;">Version 1.0.0</span> | Designed and Developed by
                    <a href="https://mcwaretechnologies.com/" target="_blank"
                        style="text-decoration: none; color: #007bff;">
                        McWare Technologies
                    </a>
                </p>
            </div>
        </div>
    </div>
</footer>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Version Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body changelog-container">
                <div class="">

                    <div class="changelog-item text-start">
                        <div class="version-header">
                            <div>
                                <span class="version-number">v 1.0.0</span>

                                <span class="latest-badge">LATEST</span>

                            </div>
                            <span class="release-date">2025-10-15</span>
                        </div>
                        <ul class="update-list">
                            <li class="update-item">
                                <span class="update-label label-new">
                                    Update
                                </span>
                                Initial Release
                            </li>
                            <li class="update-item mt-1">
                                Initial release with core functionality
                            </li>

                            <li class="update-item mt-1">
                                <a href="" target="_blank" class="text-primary">
                                    <i class="bi bi-file-pdf"></i> View Release Notes
                                </a>
                            </li>

                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>