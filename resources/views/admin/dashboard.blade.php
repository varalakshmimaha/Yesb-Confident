<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard — Yesb Confident</title>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <style>
    *{margin:0;padding:0;box-sizing:border-box}
    :root{
      --primary:#0A2342;--primary-light:#1a3a6b;--accent:#E8A020;
      --green:#1a8a4a;--red:#C0392B;--light:#F4F6F9;
      --white:#fff;--text:#1a1a2e;--muted:#777;--border:#e2e5ea;
      --shadow:0 4px 20px rgba(10,35,66,.08);
      --radius:14px;--transition:all .3s ease;
    }
    body{font-family:'DM Sans',sans-serif;background:var(--light);color:var(--text);min-height:100vh}

    .sidebar{position:fixed;left:0;top:0;bottom:0;width:250px;background:var(--primary);padding:24px 0;z-index:100;display:flex;flex-direction:column}
    .sb-logo{padding:0 24px 24px;border-bottom:1px solid rgba(255,255,255,.08);display:flex;align-items:center;gap:10px}
    .sb-logo-mark{width:36px;height:36px;border-radius:8px;overflow:hidden;flex-shrink:0}
    .sb-logo-mark svg{width:100%;height:100%}
    .sb-logo-text{font-family:'Playfair Display',serif;font-size:16px;font-weight:700;color:#fff}
    .sb-logo-sub{font-size:9px;color:rgba(255,255,255,.5);letter-spacing:2px;text-transform:uppercase}
    .sb-nav{padding:20px 0;flex:1}
    .sb-link{display:flex;align-items:center;gap:12px;padding:12px 24px;font-size:13.5px;font-weight:500;color:rgba(255,255,255,.6);cursor:pointer;transition:var(--transition);border-left:3px solid transparent;text-decoration:none}
    .sb-link:hover,.sb-link.active{background:rgba(255,255,255,.06);color:#fff;border-left-color:var(--accent)}
    .sb-link i{font-size:16px;width:20px;text-align:center;color:var(--accent);opacity:.7}
    .sb-link.active i,.sb-link:hover i{opacity:1}
    .sb-footer{padding:16px 24px;border-top:1px solid rgba(255,255,255,.08)}
    .sb-footer .sb-user{display:flex;align-items:center;gap:10px}
    .sb-avatar{width:36px;height:36px;border-radius:10px;background:var(--accent);display:flex;align-items:center;justify-content:center;color:var(--primary);font-weight:700;font-size:14px}
    .sb-user-info{font-size:13px;color:#fff;font-weight:600}
    .sb-user-role{font-size:10px;color:rgba(255,255,255,.45)}
    .btn-logout{margin-top:12px;width:100%;padding:9px;border:1.5px solid rgba(255,255,255,.15);background:transparent;color:rgba(255,255,255,.6);border-radius:8px;font-size:12px;font-weight:600;cursor:pointer;transition:var(--transition);font-family:inherit}
    .btn-logout:hover{background:rgba(255,255,255,.08);color:#fff;border-color:rgba(255,255,255,.3)}

    .main{margin-left:250px;padding:28px 32px;min-height:100vh}
    .top-bar{display:flex;justify-content:space-between;align-items:center;margin-bottom:28px}
    .top-bar h2{font-family:'Playfair Display',serif;font-size:26px;font-weight:800;color:var(--primary)}
    .top-bar .top-date{font-size:13px;color:var(--muted)}

    .stats-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:18px;margin-bottom:28px}
    .stat-card{background:var(--white);border-radius:var(--radius);padding:22px 24px;box-shadow:var(--shadow);display:flex;align-items:center;gap:16px;transition:var(--transition)}
    .stat-card:hover{transform:translateY(-3px);box-shadow:0 8px 28px rgba(10,35,66,.12)}
    .stat-icon{width:50px;height:50px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:20px;flex-shrink:0}
    .stat-icon.blue{background:rgba(10,35,66,.08);color:var(--primary)}
    .stat-icon.gold{background:rgba(232,160,32,.12);color:var(--accent)}
    .stat-icon.green{background:rgba(26,138,74,.1);color:var(--green)}
    .stat-icon.red{background:rgba(192,57,43,.1);color:var(--red)}
    .stat-info .stat-num{font-size:28px;font-weight:800;color:var(--primary);line-height:1}
    .stat-info .stat-label{font-size:12px;color:var(--muted);margin-top:4px}

    .table-card{background:var(--white);border-radius:var(--radius);box-shadow:var(--shadow);overflow:hidden}
    .table-header{padding:20px 24px;display:flex;justify-content:space-between;align-items:center;border-bottom:1px solid var(--border);flex-wrap:wrap;gap:12px}
    .table-header h3{font-size:17px;font-weight:700;color:var(--primary)}
    .table-actions{display:flex;gap:10px;align-items:center;flex-wrap:wrap}
    .search-form{display:flex;gap:10px;align-items:center;flex-wrap:wrap}
    .search-input{padding:9px 14px;border:1.5px solid var(--border);border-radius:8px;font-size:13px;font-family:inherit;outline:none;width:220px;transition:var(--transition);background:var(--light)}
    .search-input:focus{border-color:var(--accent);box-shadow:0 0 0 3px rgba(232,160,32,.1)}
    .filter-select{padding:9px 14px;border:1.5px solid var(--border);border-radius:8px;font-size:13px;font-family:inherit;outline:none;background:var(--light);cursor:pointer}
    .btn-search{padding:9px 18px;border:none;border-radius:8px;background:var(--accent);color:var(--primary);font-size:12px;font-weight:600;cursor:pointer;transition:var(--transition);font-family:inherit}
    .btn-search:hover{opacity:.85}
    .btn-export{padding:9px 18px;border:none;border-radius:8px;background:var(--primary);color:#fff;font-size:12px;font-weight:600;cursor:pointer;transition:var(--transition);font-family:inherit;display:flex;align-items:center;gap:6px;text-decoration:none}
    .btn-export:hover{background:var(--primary-light)}
    .btn-delete-all{padding:9px 18px;border:none;border-radius:8px;background:var(--red);color:#fff;font-size:12px;font-weight:600;cursor:pointer;transition:var(--transition);font-family:inherit;display:flex;align-items:center;gap:6px}
    .btn-delete-all:hover{opacity:.85}

    table{width:100%;border-collapse:collapse}
    thead{background:var(--light)}
    th{padding:13px 16px;font-size:11.5px;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.8px;text-align:left;border-bottom:1px solid var(--border)}
    td{padding:14px 16px;font-size:13px;color:var(--text);border-bottom:1px solid var(--border);vertical-align:middle}
    tr:hover td{background:rgba(232,160,32,.03)}
    .td-name{font-weight:600;color:var(--primary)}
    .td-phone a{color:var(--primary);text-decoration:none;font-weight:500}
    .td-phone a:hover{color:var(--accent)}
    .td-date{font-size:12px;color:var(--muted)}

    .status-badge{display:inline-block;padding:4px 12px;border-radius:20px;font-size:11px;font-weight:700;letter-spacing:.5px;text-transform:uppercase}
    .status-new{background:#fff3db;color:#b07a10}
    .status-contacted{background:#dcf5e7;color:#1a8a4a}
    .status-closed{background:var(--light);color:var(--muted)}

    .action-btns{display:flex;gap:6px;flex-wrap:wrap}
    .btn-action{width:32px;height:32px;border-radius:8px;border:1px solid var(--border);background:var(--white);display:inline-flex;align-items:center;justify-content:center;font-size:13px;cursor:pointer;transition:var(--transition);color:var(--muted);text-decoration:none}
    .btn-action:hover{border-color:var(--accent);color:var(--accent);background:rgba(232,160,32,.05)}
    .btn-action.delete:hover{border-color:var(--red);color:var(--red);background:rgba(192,57,43,.05)}

    .empty-state{padding:60px 20px;text-align:center}
    .empty-state i{font-size:48px;color:var(--border);margin-bottom:16px}
    .empty-state h4{font-size:17px;font-weight:700;color:var(--primary);margin-bottom:6px}
    .empty-state p{font-size:13px;color:var(--muted)}

    /* Modal */
    .modal-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:1000;align-items:center;justify-content:center;padding:20px}
    .modal-overlay.show{display:flex}
    .modal{background:var(--white);border-radius:20px;width:100%;max-width:520px;box-shadow:0 20px 60px rgba(0,0,0,.2);overflow:hidden;animation:modalIn .3s ease}
    @keyframes modalIn{from{opacity:0;transform:translateY(20px)}to{opacity:1;transform:translateY(0)}}
    .modal-head{padding:20px 24px;border-bottom:1px solid var(--border);display:flex;justify-content:space-between;align-items:center}
    .modal-head h3{font-size:18px;font-weight:700;color:var(--primary)}
    .modal-close{width:34px;height:34px;border-radius:8px;border:1px solid var(--border);background:var(--white);display:flex;align-items:center;justify-content:center;font-size:14px;cursor:pointer;color:var(--muted);transition:var(--transition)}
    .modal-close:hover{background:var(--light);color:var(--primary)}
    .modal-body{padding:24px}
    .modal-row{display:flex;gap:16px;margin-bottom:16px}
    .modal-row .m-field{flex:1}
    .m-field label{display:block;font-size:11px;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px}
    .m-field .m-value{font-size:14px;color:var(--primary);font-weight:500;padding:10px 14px;background:var(--light);border-radius:8px;word-break:break-word}
    .m-field .m-value a{color:var(--accent);text-decoration:none}
    .m-field .m-value.msg{min-height:60px;line-height:1.7;color:var(--text);font-weight:400}
    .modal-foot{padding:16px 24px;border-top:1px solid var(--border);display:flex;justify-content:flex-end;gap:10px}
    .btn-modal{padding:10px 22px;border-radius:10px;font-size:13px;font-weight:600;cursor:pointer;transition:var(--transition);font-family:inherit;border:none}
    .btn-modal.primary{background:var(--green);color:#fff}
    .btn-modal.primary:hover{opacity:.85}
    .btn-modal.secondary{background:var(--light);color:var(--primary);border:1px solid var(--border)}
    .btn-modal.secondary:hover{background:var(--border)}

    .alert{padding:12px 18px;border-radius:10px;margin-bottom:18px;font-size:13px;font-weight:600;display:flex;align-items:center;gap:8px}
    .alert-success{background:#dcf5e7;color:#1a8a4a}

    /* Tab panes */
    .tab-pane{display:none}
    .tab-pane.show{display:block}
    .tab-pane.stats-grid.show{display:grid}

    /* Settings */
    .settings-form{padding:28px 24px}
    .settings-grid{display:grid;grid-template-columns:1fr 1fr;gap:32px}
    .s-section-title{font-size:14px;font-weight:700;color:var(--primary);margin-bottom:18px;padding-bottom:10px;border-bottom:1px solid var(--border);display:flex;align-items:center;gap:8px}
    .s-section-title i{color:var(--accent)}
    .s-label{display:block;font-size:11px;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin:14px 0 6px;display:flex;align-items:center;gap:8px}
    .s-input{width:100%;padding:10px 14px;border:1.5px solid var(--border);border-radius:8px;font-size:13px;font-family:inherit;outline:none;background:var(--light);transition:var(--transition)}
    .s-input:focus{border-color:var(--accent);box-shadow:0 0 0 3px rgba(232,160,32,.1);background:var(--white)}
    .s-hint{font-size:11px;color:var(--muted);margin-top:6px}
    .logo-preview-box{width:100%;height:140px;border:2px dashed var(--border);border-radius:10px;display:flex;align-items:center;justify-content:center;margin-bottom:8px;background:var(--light);overflow:hidden}
    .logo-preview-box img{max-width:100%;max-height:100%;object-fit:contain}
    .logo-placeholder{display:flex;flex-direction:column;align-items:center;gap:8px;color:var(--muted);font-size:12px}
    .logo-placeholder i{font-size:32px;opacity:.4}
    .settings-foot{padding:20px 0 0;border-top:1px solid var(--border);margin-top:28px;display:flex;justify-content:flex-end}
    .settings-foot .btn-search{padding:11px 26px;font-size:13px;display:flex;align-items:center;gap:8px}
    @media(max-width:900px){.settings-grid{grid-template-columns:1fr}}

    @media(max-width:900px){
      .sidebar{width:60px;padding:16px 0}
      .sb-logo-text,.sb-logo-sub,.sb-link span,.sb-user-info,.sb-user-role,.btn-logout span{display:none}
      .sb-logo{padding:0 12px 16px;justify-content:center}
      .sb-link{justify-content:center;padding:12px 0}
      .sb-link i{margin:0}
      .main{margin-left:60px;padding:20px 16px}
      .stats-grid{grid-template-columns:repeat(2,1fr)}
      .table-actions{flex-wrap:wrap}
      .search-input{width:160px}
    }
  </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
  <div class="sb-logo">
    <div class="sb-logo-mark">
      <svg viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
        <rect width="36" height="36" rx="8" fill="#0A2342"/>
        <path d="M6 27 L13 10 L18 23 L23 10 L30 27" stroke="#E8A020" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
        <circle cx="18" cy="9" r="2.5" fill="#E8A020"/>
      </svg>
    </div>
    <div>
      <div class="sb-logo-text">Yesb Confident</div>
      <div class="sb-logo-sub">Admin Panel</div>
    </div>
  </div>
  <div class="sb-nav">
    <a href="#dashboard" class="sb-link" data-tab="dashboard"><i class="fas fa-chart-pie"></i><span>Dashboard</span></a>
    <a href="#enquiries" class="sb-link" data-tab="enquiries"><i class="fas fa-envelope-open-text"></i><span>Enquiries</span></a>
    <a href="#settings" class="sb-link" data-tab="settings"><i class="fas fa-cog"></i><span>Settings</span></a>
    <a href="{{ route('home') }}" target="_blank" class="sb-link"><i class="fas fa-globe"></i><span>View Website</span></a>
  </div>
  <div class="sb-footer">
    <div class="sb-user">
      <div class="sb-avatar">A</div>
      <div>
        <div class="sb-user-info">Admin</div>
        <div class="sb-user-role">Super Admin</div>
      </div>
    </div>
    <form action="{{ route('admin.logout') }}" method="POST">
      @csrf
      <button type="submit" class="btn-logout"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></button>
    </form>
  </div>
</div>

<!-- Main Content -->
<div class="main">
  <div class="top-bar">
    <h2 id="pageTitle">Dashboard</h2>
    <div class="top-date">{{ now()->format('l, F j, Y') }}</div>
  </div>

  @if(session('success'))
    <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
  @endif

  @if($errors->any())
    <div class="alert" style="background:#fde8e8;color:#b02a2a">
      <i class="fas fa-exclamation-circle"></i>
      <div>@foreach($errors->all() as $err)<div>{{ $err }}</div>@endforeach</div>
    </div>
  @endif

  <!-- Stats (Dashboard tab only) -->
  <div class="stats-grid tab-pane" data-pane="dashboard">
    <div class="stat-card">
      <div class="stat-icon blue"><i class="fas fa-envelope"></i></div>
      <div class="stat-info"><div class="stat-num">{{ $stats['total'] }}</div><div class="stat-label">Total Enquiries</div></div>
    </div>
    <div class="stat-card">
      <div class="stat-icon gold"><i class="fas fa-clock"></i></div>
      <div class="stat-info"><div class="stat-num">{{ $stats['new'] }}</div><div class="stat-label">New / Pending</div></div>
    </div>
    <div class="stat-card">
      <div class="stat-icon green"><i class="fas fa-check-circle"></i></div>
      <div class="stat-info"><div class="stat-num">{{ $stats['contacted'] }}</div><div class="stat-label">Contacted</div></div>
    </div>
    <div class="stat-card">
      <div class="stat-icon red"><i class="fas fa-times-circle"></i></div>
      <div class="stat-info"><div class="stat-num">{{ $stats['closed'] }}</div><div class="stat-label">Closed</div></div>
    </div>
  </div>

  <!-- Enquiries Table (Dashboard + Enquiries tabs) -->
  <div class="table-card tab-pane" id="tableCard" data-pane="dashboard enquiries">
    <div class="table-header">
      <h3><i class="fas fa-inbox" style="color:var(--accent);margin-right:8px"></i>All Enquiries</h3>
      <div class="table-actions">
        <form class="search-form" action="{{ route('admin.dashboard') }}" method="GET">
          <input class="search-input" type="text" name="search" placeholder="Search name, phone..." value="{{ request('search') }}">
          <select class="filter-select" name="status">
            <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All Status</option>
            <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>New</option>
            <option value="contacted" {{ request('status') == 'contacted' ? 'selected' : '' }}>Contacted</option>
            <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed</option>
          </select>
          <button type="submit" class="btn-search"><i class="fas fa-search"></i> Search</button>
        </form>
        <a href="{{ route('admin.export') }}" class="btn-export"><i class="fas fa-download"></i> Export CSV</a>
        <form action="{{ route('admin.enquiry.destroyAll') }}" method="POST" onsubmit="return confirm('Delete ALL enquiries? This cannot be undone.')">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn-delete-all"><i class="fas fa-trash"></i> Clear All</button>
        </form>
      </div>
    </div>

    @if($enquiries->isEmpty())
      <div class="empty-state">
        <i class="fas fa-inbox"></i>
        <h4>No Enquiries Found</h4>
        <p>{{ request('search') || request('status') ? 'Try adjusting your search or filter.' : 'Enquiries submitted on the website will appear here.' }}</p>
      </div>
    @else
      <table>
        <thead>
          <tr>
            <th>#</th><th>Name</th><th>Phone</th><th>Email</th><th>Occupation</th><th>Affiliate</th><th>Date</th><th>Status</th><th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($enquiries as $index => $enquiry)
            <tr>
              <td style="color:var(--muted)">{{ $index + 1 }}</td>
              <td class="td-name">{{ $enquiry->name }}</td>
              <td class="td-phone"><a href="tel:{{ $enquiry->phone }}">{{ $enquiry->phone }}</a></td>
              <td>{{ $enquiry->email ?? '—' }}</td>
              <td>{{ $enquiry->occupation }}</td>
              <td><span class="status-badge {{ $enquiry->affiliate_interest == 'yes' ? 'status-contacted' : 'status-closed' }}">{{ $enquiry->affiliate_interest == 'yes' ? 'Yes' : 'No' }}</span></td>
              <td class="td-date">{{ $enquiry->created_at->format('d/m/Y') }}</td>
              <td><span class="status-badge status-{{ $enquiry->status }}">{{ $enquiry->status }}</span></td>
              <td>
                <div class="action-btns">
                  <button class="btn-action" title="View" onclick="viewEnquiry({{ $enquiry->id }})"><i class="fas fa-eye"></i></button>
                  <a class="btn-action" title="Call" href="tel:{{ $enquiry->phone }}"><i class="fas fa-phone"></i></a>
                  <a class="btn-action" title="WhatsApp" href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $enquiry->phone) }}" target="_blank"><i class="fab fa-whatsapp"></i></a>
                  <form action="{{ route('admin.enquiry.destroy', $enquiry) }}" method="POST" style="display:inline" onsubmit="return confirm('Delete this enquiry?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-action delete" title="Delete"><i class="fas fa-trash"></i></button>
                  </form>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @endif
  </div>

  <!-- Settings Pane -->
  <div class="table-card tab-pane" data-pane="settings">
    <div class="table-header">
      <h3><i class="fas fa-cog" style="color:var(--accent);margin-right:8px"></i>Website Settings</h3>
    </div>
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="settings-form">
      @csrf
      <div class="settings-grid">
        <div class="s-section">
          <h4 class="s-section-title"><i class="fas fa-image"></i> Site Logo</h4>
          <div class="logo-preview-box">
            @if($settings['logo_path'])
              <img src="{{ asset('storage/' . $settings['logo_path']) }}" alt="Current logo" id="logoPreview">
            @else
              <div class="logo-placeholder" id="logoPreview"><i class="fas fa-image"></i><span>No logo uploaded</span></div>
            @endif
          </div>
          <label class="s-label">Upload New Logo</label>
          <input type="file" name="logo" accept="image/*" class="s-input" onchange="previewLogo(event)">
          <div class="s-hint">JPG, PNG, SVG, or WEBP. Max 2MB. Recommended: 200×60px.</div>
        </div>

        <div class="s-section">
          <h4 class="s-section-title"><i class="fas fa-share-nodes"></i> Social Media Links</h4>

          <label class="s-label"><i class="fab fa-facebook-f" style="color:#1877F2"></i> Facebook URL</label>
          <input type="url" name="facebook_url" value="{{ old('facebook_url', $settings['facebook_url']) }}" placeholder="https://facebook.com/yourpage" class="s-input">

          <label class="s-label"><i class="fab fa-instagram" style="color:#E4405F"></i> Instagram URL</label>
          <input type="url" name="instagram_url" value="{{ old('instagram_url', $settings['instagram_url']) }}" placeholder="https://instagram.com/yourhandle" class="s-input">

          <label class="s-label"><i class="fab fa-youtube" style="color:#FF0000"></i> YouTube URL</label>
          <input type="url" name="youtube_url" value="{{ old('youtube_url', $settings['youtube_url']) }}" placeholder="https://youtube.com/@yourchannel" class="s-input">

          <label class="s-label"><i class="fab fa-twitter" style="color:#1DA1F2"></i> Twitter / X URL</label>
          <input type="url" name="twitter_url" value="{{ old('twitter_url', $settings['twitter_url']) }}" placeholder="https://twitter.com/yourhandle" class="s-input">

          <label class="s-label"><i class="fab fa-whatsapp" style="color:#25D366"></i> WhatsApp (number or wa.me link)</label>
          <input type="text" name="whatsapp_url" value="{{ old('whatsapp_url', $settings['whatsapp_url']) }}" placeholder="918884110767 or https://wa.me/918884110767" class="s-input">
        </div>
      </div>
      <div class="settings-foot">
        <button type="submit" class="btn-search"><i class="fas fa-save"></i> Save Settings</button>
      </div>
    </form>
  </div>
</div>

<!-- View Modal -->
<div class="modal-overlay" id="viewModal" onclick="if(event.target===this)closeModal()">
  <div class="modal">
    <div class="modal-head">
      <h3><i class="fas fa-user" style="color:var(--accent);margin-right:8px"></i>Enquiry Details</h3>
      <button class="modal-close" onclick="closeModal()"><i class="fas fa-times"></i></button>
    </div>
    <div class="modal-body">
      <div class="modal-row">
        <div class="m-field"><label>Full Name</label><div class="m-value" id="mName"></div></div>
        <div class="m-field"><label>Contact Number</label><div class="m-value" id="mPhone"></div></div>
      </div>
      <div class="modal-row">
        <div class="m-field" style="flex:1"><label>Address</label><div class="m-value" id="mAddress"></div></div>
      </div>
      <div class="modal-row">
        <div class="m-field"><label>Email</label><div class="m-value" id="mEmail"></div></div>
        <div class="m-field"><label>Date</label><div class="m-value" id="mDate"></div></div>
      </div>
      <div class="modal-row">
        <div class="m-field"><label>Occupation</label><div class="m-value" id="mOccupation"></div></div>
        <div class="m-field"><label>Affiliate Interest</label><div class="m-value" id="mAffiliate"></div></div>
      </div>
      <div class="modal-row">
        <div class="m-field" style="flex:1"><label>Affiliate Experience</label><div class="m-value msg" id="mExperience"></div></div>
      </div>
      <form id="statusForm" method="POST">
        @csrf
        @method('PATCH')
        <div class="modal-row">
          <div class="m-field"><label>Update Status</label>
            <select class="filter-select" name="status" id="mStatus" style="width:100%;margin-top:4px">
              <option value="new">New</option>
              <option value="contacted">Contacted</option>
              <option value="closed">Closed</option>
            </select>
          </div>
        </div>
    </div>
    <div class="modal-foot">
      <button type="button" class="btn-modal secondary" onclick="closeModal()">Cancel</button>
      <button type="submit" class="btn-modal primary"><i class="fas fa-check"></i>&nbsp; Save Status</button>
    </div>
    </form>
  </div>
</div>

<script>
  // Enquiry data from server
  const enquiries = @json($enquiries->keyBy('id'));

  function viewEnquiry(id) {
    const e = enquiries[id];
    if (!e) return;
    document.getElementById('mName').textContent = e.name;
    document.getElementById('mPhone').innerHTML = '<a href="tel:' + e.phone + '">' + e.phone + '</a>';
    document.getElementById('mAddress').textContent = e.address || '—';
    document.getElementById('mEmail').textContent = e.email || '—';
    document.getElementById('mDate').textContent = new Date(e.created_at).toLocaleString('en-IN');
    document.getElementById('mOccupation').textContent = e.occupation || '—';
    document.getElementById('mAffiliate').textContent = e.affiliate_interest === 'yes' ? 'Yes, Interested' : 'No';
    document.getElementById('mExperience').textContent = e.affiliate_experience || 'No experience mentioned.';
    document.getElementById('mStatus').value = e.status;
    document.getElementById('statusForm').action = '/admin/enquiry/' + id + '/status';
    document.getElementById('viewModal').classList.add('show');
  }

  function closeModal() {
    document.getElementById('viewModal').classList.remove('show');
  }

  // ===== TAB SWITCHING =====
  const tabTitles = { dashboard: 'Dashboard', enquiries: 'Enquiries', settings: 'Settings' };

  function showTab(name) {
    if (!tabTitles[name]) name = 'dashboard';
    document.querySelectorAll('.tab-pane').forEach(p => {
      const panes = (p.dataset.pane || '').split(' ');
      p.classList.toggle('show', panes.includes(name));
    });
    document.querySelectorAll('.sb-link[data-tab]').forEach(a => {
      a.classList.toggle('active', a.dataset.tab === name);
    });
    document.getElementById('pageTitle').textContent = tabTitles[name];
    if (location.hash !== '#' + name) history.replaceState(null, '', '#' + name);
  }

  document.querySelectorAll('.sb-link[data-tab]').forEach(link => {
    link.addEventListener('click', e => {
      e.preventDefault();
      showTab(link.dataset.tab);
    });
  });

  // Initial tab: URL hash > query param > default
  const urlParams = new URLSearchParams(location.search);
  const initialTab = (location.hash || '').replace('#', '') || urlParams.get('tab') || 'dashboard';
  showTab(initialTab);

  // ===== LOGO PREVIEW =====
  function previewLogo(e) {
    const file = e.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = ev => {
      const box = document.querySelector('.logo-preview-box');
      box.innerHTML = '<img src="' + ev.target.result + '" alt="Preview">';
    };
    reader.readAsDataURL(file);
  }
</script>

</body>
</html>
