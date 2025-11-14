<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Job Card - Swift Print</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #fff;
            color: #222;
            font-family: Arial, Helvetica, sans-serif;
        }

        .job-card {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            box-shadow: 0 0 0 rgba(0, 0, 0, 0);
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand img {
            height: 48px;
            width: auto;
        }

        .company {
            font-weight: 700;
        }

        .job-no {
            text-align: right;
            font-weight: 800;
            color: #6c757d;
            font-size: 28px;
        }

        .line {
            border-top: 1px solid #ccc;
            margin: 10px 0;
        }

        .field-label {
            font-weight: 600;
            font-size: 14px;
        }

        .box {
            border: 1px solid #bfbfbf;
            background: #fff;
            padding: 6px 8px;
            min-height: 34px;
        }

        .small-box {
            border: 1px solid #bfbfbf;
            width: 70px;
            height: 28px;
            display: inline-block;
            margin-right: 8px;
            vertical-align: middle;
        }

        .grid-row {
            display: grid;
            grid-template-columns: 1fr 160px;
            gap: 12px;
            align-items: center;
        }

        .form-row {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .table-spec {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
        }

        .table-spec td,
        .table-spec th {
            border: 1px solid #ddd;
            padding: 6px;
            vertical-align: middle;
            font-size: 13px;
        }

        .spec-input {
            border: 1px solid #ddd;
            padding: 6px;
            min-width: 90px;
            display: inline-block;
        }

        .section {
            margin-top: 12px;
        }

        .note-box {
            border: 1px solid #bfbfbf;
            min-height: 70px;
            padding: 8px;
        }

        .footer {
            margin-top: 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        @media print {
            .job-card {
                box-shadow: none;
                border: none;
            }
        }
    </style>
</head>

<body>
    <div class="job-card">
        <div class="header">
            <div class="brand">
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAABgklEQVR4nO2a0U3DMBREb0oQBE0gQpEoRBM0gQpEoQZbG4g2m2M0r1v9q2s0k43R3s3v3+9+vE4Yp4B3gA8gGzhmICbQn2u0tC9w7wG7gQy2oA4Q2wJc4k9bqmw1oq4D2m4HhQp4b8gG8Q8Qm8QwKxw8wD0Qk8Y8Qq8QwGxw8wD0Qk8Y8Qq8QwGxw8wD0Qk8Y8Qq8QwGxw8wD0Qk8Y8Qq8QwGxw8wD0Qk8Y8Qq8QwGxw8wD0Qk8Y8Qq8QwGxw8wD0Qk8Y8Qq8QwGxw8wD0Qk8Y8Qq8QwGxw8wD0Qk8Y8Qq8QwGxw8wD0Qm8Y8Qq8AwLxg7ANuE6wDLEO8Bzhr7wz0c4j1wD3gE8gN6D3wGvX1v8z6O7gX0g6wD7gO8g0wJcYQk6z2l0wAAAABJRU5ErkJggg=="
                    alt="logo">
                <div>
                    <div class="company">Swift Print Connection Pvt. Ltd.</div>
                    <div class="text-muted">Mid-Baneshwor-10, Kathmandu</div>
                </div>
            </div>
            <div class="job-no">JOB<br>CARD</div>
        </div>

        <div class="line"></div>

        <div class="section grid-row">
            <div>
                <div class="d-flex mb-2">
                    <div class="me-3" style="min-width:110px;"><span class="field-label">Name</span></div>
                    <div class="flex-fill box"></div>
                </div>
                <div class="d-flex mb-2">
                    <div class="me-3" style="min-width:110px;"><span class="field-label">Address</span></div>
                    <div class="flex-fill box"></div>
                </div>
            </div>

            <div>
                <div class="d-flex mb-2">
                    <div class="me-2" style="min-width:65px;"><span class="field-label">Date</span></div>
                    <div class="box" style="width:120px;"></div>
                </div>
                <div class="d-flex">
                    <div class="me-2" style="min-width:65px;"><span class="field-label">Delivery Date</span></div>
                    <div class="box" style="width:120px;"></div>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="field-label mb-1">Job Description</div>
            <div class="box" style="min-height:36px;"></div>

            <table class="table-spec mt-2">
                <tr>
                    <th style="width:20%;">Quantity</th>
                    <th style="width:18%;">Pages: BW</th>
                    <th style="width:18%;">CMYK</th>
                    <th style="width:18%;">Total Page</th>
                    <th style="width:26%;">Size</th>
                </tr>
                <tr>
                    <td>
                        <div class="spec-input"></div>
                    </td>
                    <td>
                        <div class="spec-input"></div>
                    </td>
                    <td>
                        <div class="spec-input"></div>
                    </td>
                    <td>
                        <div class="spec-input"></div>
                    </td>
                    <td>
                        <div class="spec-input"></div>
                    </td>
                </tr>
            </table>
        </div>

        <div class="section">
            <div class="d-flex gap-3 align-items-center mb-2">
                <span class="field-label">Total Plate:</span>
                <div class="small-box"></div>
                <span> Total Farma: </span>
                <div class="spec-input" style="width:120px; display:inline-block;"></div>
                <div class="d-flex gap-2 ms-3">
                    <label class="small mb-0"><input type="checkbox"> 32 page</label>
                    <label class="small mb-0 ms-2"><input type="checkbox"> 16 page</label>
                    <label class="small mb-0 ms-2"><input type="checkbox"> 8 page</label>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="field-label mb-1">Inner Paper Detail-1</div>
            <div class="d-flex gap-2 mb-2">
                <div class="flex-fill">
                    <div class="small-box" style="width:220px; height:28px;"></div>
                </div>
                <div style="min-width:120px;">
                    <div class="small-box" style="width:120px;"></div>
                </div>
                <div style="min-width:120px;">
                    <div class="small-box" style="width:120px;"></div>
                </div>
                <div style="min-width:120px;">
                    <div class="small-box" style="width:120px;"></div>
                </div>
            </div>

            <div class="field-label mb-1">Cover Paper Detail</div>
            <div class="d-flex gap-2 mb-2">
                <div class="flex-fill">
                    <div class="small-box" style="width:220px;"></div>
                </div>
                <div style="min-width:120px;">
                    <div class="small-box" style="width:120px;"></div>
                </div>
                <div style="min-width:120px;">
                    <div class="small-box" style="width:120px;"></div>
                </div>
                <div style="min-width:120px;">
                    <div class="small-box" style="width:120px;"></div>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="field-label mb-1">Remarks</div>
            <div class="note-box"></div>
        </div>

        <div class="section">
            <div class="field-label mb-1">Special Instruction</div>
            <div class="note-box"></div>
        </div>

        <div class="footer">
            <div>Prepared by</div>
            <div></div>
        </div>
    </div>
</body>

</html>
