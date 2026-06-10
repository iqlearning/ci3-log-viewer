<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="noindex, nofollow">
    <title>Log Viewer</title>
    <link href="<?php echo base_url('assets/iqtool/ci3-log-viewer/app.css'); ?>" rel="stylesheet">
</head>
<body class="h-full overflow-hidden">
    <div id="log-viewer" class="h-full"></div>

    <!-- Global LogViewer Object -->
    <script>
        window.LogViewer = <?php echo json_encode($logViewerScriptVariables); ?>;
    </script>

    <script src="<?php echo base_url('assets/iqtool/ci3-log-viewer/app.js'); ?>"></script>
</body>
</html>
