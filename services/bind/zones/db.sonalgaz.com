$TTL 86400
@   IN  SOA ns.sonalgaz.com. admin.sonalgaz.com. (
        2025022701  ; Serial
        3600        ; Refresh
        1800        ; Retry
        604800      ; Expire
        86400 )     ; Minimum TTL

    IN  NS  ns.sonalgaz.com.
ns  IN  A   172.21.1.6
www IN  A   172.21.0.7
ftp IN  A   172.21.0.9
