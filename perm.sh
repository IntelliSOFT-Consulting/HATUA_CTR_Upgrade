echo "Assiging permissions to users..."
app/Console/cake AclExtras.AclExtras aco_sync #Latest that works well

# app/Console/cake acl_extras aco_sync
# app/Console/cake cache clear_all
# app/Console/cake AclExtras.AclExtras aco_sync
# echo "*************** Assign Admin Permissions  *******************"
# #Admin permissions
# app/Console/cake acl grant Group.1 controllers
# # Allow managers to some controllers
# echo "*************** Assign Managers Permissions  *******************"
# app/Console/cake acl deny Group.2 controllers
# app/Console/cake acl grant Group.2 controllers/Applications/manager_invoice
# app/Console/cake acl grant Group.2 controllers/Applications/manager_verify_invoice


# Clear 
# app/Console/cake cache clear_all
