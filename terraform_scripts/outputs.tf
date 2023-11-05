output "security_group_id" {
  value = aws_security_group.security_group.id
}

output "public_ip" {
  value = aws_instance.ec2_instance.public_ip
}
