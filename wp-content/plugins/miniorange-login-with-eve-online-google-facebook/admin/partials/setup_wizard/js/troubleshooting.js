/* Discovery URL troubleshooting Div */
function mo_get_discovery_troubleshooting(discovery_url,mo_oauth_input,appId) {
    jQuery("#mo-oauth-troubleshooting-ul").empty();
    if(undefined != mo_oauth_input){
        jQuery("#discInput").val(mo_oauth_input);
        var inputs = mo_oauth_input.split(" ");
        for(i in inputs){
            if('Domain' === inputs[i]){
                jQuery("#mo-oauth-troubleshooting-ul").append("<li class=mo-oauth-troubleshooting-item> Add prefix http or https to the domain name </li>");
                jQuery("#mo-oauth-troubleshooting-ul").append("<li class=mo-oauth-troubleshooting-item> Try adding/removing port number from the domain name </li>");
            }else if('Tenant' === inputs[i] && 'azureb2c' === appId){
                jQuery("#mo-oauth-troubleshooting-ul").append("<li class=mo-oauth-troubleshooting-item> Tenant name is a portain of your Azure B2C domain. For example: if the domain is <b> example.onmicrosoft.com</b> then tenant name should be <b>'example'</b>.</li>");
                jQuery("#mo-oauth-troubleshooting-ul").append("<li class=mo-oauth-troubleshooting-item> Check if you have added correct Tenant name  <a href='https://plugins.miniorange.com/azure-b2c-ad-single-sign-on-wordpress-sso-oauth-openid-connect#tenant' target=_blank>  Find tenant name here </a> </li>");
            }else if('Policy' === inputs[i]){
                jQuery("#mo-oauth-troubleshooting-ul").append("<li class=mo-oauth-troubleshooting-item> Check if you have added correct Policy name <a href='https://plugins.miniorange.com/azure-b2c-ad-single-sign-on-wordpress-sso-oauth-openid-connect#step_azure_b2c_policy' target=_blank>  Find Policy name here </a> </li>");                
            }else{
                jQuery("#mo-oauth-troubleshooting-ul").append("<li class=mo-oauth-troubleshooting-item> Check if you have added correct "+inputs[i]+" name </li>");
            }
        }
        
    }
    jQuery("#mo-oauth-troubleshooting-ul").append("<li class=mo-oauth-troubleshooting-item> Click on the discovery endpoint and check if you are receiving OIDC metadata <a href='"+ discovery_url +"' target=_blank> "+ discovery_url+" </li>");
}