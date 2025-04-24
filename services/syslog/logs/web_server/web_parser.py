import time
import re

# Expression régulière
log_regex = re.compile(
    r'(?P<ip>\d+\.\d+\.\d+\.\d+)\s'
    r'- - \[(?P<datetime>[^\]]+)\] '
    r'"(?P<method>\w+)\s(?P<url>.*?)\s(?P<protocol>[^"]+)"\s'
    r'(?P<status>\d{3})\s'
    r'(?P<size>\d+)\s'
    r'"(?P<referer>[^"]*)"\s'
    r'"(?P<useragent>[^"]*)"'
)

# Fichiers source/destination
log_source = 'access.log'
log_parsed = 'parsed_web/access_parsed.log'

# Lecture en continu
with open(log_source, 'r') as src, open(log_parsed, 'a') as dst:
    src.seek(0, 2)  # aller à la fin du fichier

    while True:
        line = src.readline()
        if not line:
            time.sleep(0.5)
            continue

        match = log_regex.search(line)
        if match:
            data = match.groupdict()
            # Format de sortie custom
            formatted = (
                f"[{data['datetime']}] {data['ip']} "
                f"{data['method']} {data['url']} "
                f"-> {data['status']} ({data['size']}B) "
                f"Agent: {data['useragent']}\n"
            )
            dst.write(formatted)
            dst.flush()
