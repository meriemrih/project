#!/bin/bash
set -e

# allow arguments to be passed to named
if [[ "${1:0:1}" == '-' ]]; then
    EXTRA_ARGS="${*}"
    set --
elif [[ "${1}" == "named" || "${1}" == "$(command -v named)" ]]; then
    EXTRA_ARGS="${*:2}"
    set --
fi

# The user which will start the named process.  If not specified,
# defaults to 'bind'.
BIND9_USER="${BIND9_USER:-bind}"

# default behaviour is to launch named
if [[ -z "${1}" ]]; then
    echo "Starting named..."
    echo "exec $(which named) -u \"${BIND9_USER}\" -g \"${EXTRA_ARGS}\""
    exec $(command -v named) -u "${BIND9_USER}" -f ${EXTRA_ARGS}
else
    exec "${@}"
fi
