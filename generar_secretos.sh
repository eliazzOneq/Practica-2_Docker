#!/bin/bash
mkdir -p docker/secrets

openssl rand -base64 32 > docker/secrets/app_key.txt
openssl rand -base64 24 > docker/secrets/db_password.txt

echo "Secretos generados correctamente."