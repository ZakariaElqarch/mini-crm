<!DOCTYPE html>
<html>
<head>
    <style>
        html, body {
            padding: 0;
            margin: 0;
        }
    </style>
</head>
<body>
    <div style="font-family:Arial,Helvetica,sans-serif; line-height: 1.5; font-weight: normal; font-size: 15px; color: #2F3044; min-height: 100%; margin:0; padding:0; width:100%; background-color:#edf2f7">
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;margin:0 auto; padding:0; max-width:600px">
            <tbody>
                <tr>
                    <td align="center" valign="center" style="text-align:center; padding: 40px">
                        {{-- <a href="https://illizeo.com" rel="noopener" target="_blank"> --}}
                            <img alt="Logo" src="https://illizeo.com/wp-content/uploads/2021/12/logo-illizeo-vectorise-infomaniak.png" />
                        {{-- </a> --}}
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="center">
                        <div style="text-align:left; margin: 0 20px; padding: 40px; background-color:#ffffff; border-radius: 6px">
                            <!--begin:Email content-->
                            <div style="padding-bottom: 30px; font-size: 17px;">
                                <strong>Welcome to {{ $company->name }}!</strong>
                            </div>
                            <div style="padding-bottom: 30px">
                                You have been invited to join the {{ $company->name }} team by {{ $admin_name }}. To get started, accept the invite below:
                            </div>
                            <div style="padding-bottom: 40px; text-align:center;">
                                <a href="{{ $inviteUrl }}" rel="noopener" target="_blank" style="text-decoration:none;display:inline-block;text-align:center;padding:0.75575rem 1.3rem;font-size:0.925rem;line-height:1.5;border-radius:0.35rem;color:#ffffff;background-color:#009ef7;border:0px;margin-right:0.75rem!important;font-weight:600!important;outline:none!important;vertical-align:middle">
                                    Accept Invite
                                </a>
                            </div>
                            <div style="padding-bottom: 30px">
                                Joining the team will give you access to the company's CRM dashboard, including information about your colleagues and company data.
                            </div>
                            <div style="padding-bottom: 30px">
                                If you have any questions, please contact your administrator or reply to this email.
                            </div>
                            <!--end:Email content-->
                            <div style="padding-bottom: 10px">
                                Kind regards,<br>The {{ $company->name }} Team.
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="center" valign="center" style="font-size: 13px; text-align:center;padding: 20px; color: #6d6e7c;">
                        <p>Copyright © <a href="https://illizeo.com" rel="noopener" target="_blank">Illizeo</a>.</p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>